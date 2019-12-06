<template>
    <div>
        <div class="content">
            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Пользователи:</h4>
                        </div>
                        <div class="card-body">
                            <div class="users">
                                <selection-group-users
                                        :users="users.teachers"
                                        title-group="Преподаватели"
                                        @change="setSelected($event)"
                                        :selected-users="selected"
                                        group="teachers"
                                        type="teachers"
                                />
                                <br>

                                <selection-group-users
                                        :users="users.applicants"
                                        title-group="Абитуриенты"
                                        @change="setSelected($event)"
                                        :selected-users="selected"
                                        group="applicants"
                                        type="applicants"
                                />
                                <br>

                                <div><strong>Студенты</strong></div>
                                <br>
                                <div v-for="group in users.groups">
                                    <selection-group-users
                                            :users="group.students"
                                            :title-group="group.name"
                                            @change="setSelected($event)"
                                            :selected-users="selected"
                                            :group="group.id"
                                            type="students"
                                    />
                                    <br>
                                </div>

                                <!--<selection-group-users-->
                                        <!--:users="users.others"-->
                                        <!--title-group="Прочее"-->
                                        <!--@change="setSelected($event)"-->
                                        <!--:selected-users="selected"-->
                                        <!--group="others"-->
                                <!--/>-->
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Сообщение:</h4>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" cols="30" rows="10"
                                placeholder="Сообщение для рассылки" v-model="message">
                            </textarea>
                            <br>
                            <label for="file">Выберите изображение:</label>
                            <input class="form-control"
                                   type="file"
                                   id="file" ref="file"
                                   accept="image/png, image/jpeg"
                                   @change="handleFileUpload()">
                            <br>
                            <button class="form-control btn btn-primary" @click="send()">
                                Отправить (получателей: {{ countRecipients }})
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import SelectionGroupUsers from './SelectionGroupUsers';
    import Swal from 'sweetalert2'

    export default {
        data: () => ({
            selected: [],
            checkAllTeachers: false,
            countRecipients: 0,
            users: [],
            message: null,
            file: '',
        }),
        components: {SelectionGroupUsers},
        methods: {
            handleFileUpload(){
                this.file = this.$refs.file.files[0];
            },
            setSelected(telegramId) {
                let index = this.selected.indexOf(telegramId);

                if (index !== -1) Vue.delete(this.selected, index);
                else this.selected.push(telegramId);

                this.countRecipients = this.selected.length;
            },
            send() {
                let formData = new FormData();
                formData.append('message', this.message);
                for(let i=0; i < this.selected.length; i++){
                    formData.append('users[]', this.selected[i])
                }
                formData.append('file', this.file);
                if(this.selected.length && this.message) {
                    axios.post('/admin/send-telegram-message', formData,
                    {
                        headers: {
                            'Content-Type': 'multipart/form-data'
                        },
                    }).then(response => {
                        this.message = null;
                        Swal.fire(
                            'Отправленно',
                            `Ваше сообщение успешно отправленно.
                            <span style="color: green">Доставлено: ${response.data.delivered}.</span>
                            <span style="color: red">Ошибка отправки: ${response.data.undelivered}</span>.
                            <a target="_blank" href="/admin/telegram-bot/mailing/${response.data.mailId}">Детали</a>`,
                            'success'
                        )
                    }).catch(error => {
                        Swal.fire(
                            'Ошибка',
                            'Упс.. Произошла ошибка',
                            'error'
                        )
                    });
                }else {
                    Swal.fire(
                        'Ошибка',
                        'Выберете получателей и введите сообщение',
                        'error'
                    )
                }
            }
        },
        created() {
            axios.get('/get-all-cathedra-users').then(response => {
                this.users = response.data;
            });
        }
    }
</script>

<style>
    .users {
        max-height: 400px;
        overflow-y: scroll;
    }
</style>
