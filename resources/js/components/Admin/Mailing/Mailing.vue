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
                                <hr>

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
                                <selection-group-users
                                        :users="users.emailSubscribers"
                                        title-group="Email-подписчики"
                                        @change="setSelected($event)"
                                        :selected-users="selected"
                                        group="emailSubscribers"
                                        type="emailSubscribers"
                                />
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
                            <button class="form-control btn btn-primary" @click="send()">
                                Отправить (получателей: {{ countRecipients }})
                                <span v-if="selected.length > 100">Максимум 100 получателей</span>
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
    import Swal from 'sweetalert2';

    export default {
        data: () => ({
            selected: [],
            countRecipients: 0,
            users: [],
            message: null,
        }),
        components: {
            SelectionGroupUsers,
        },
        methods: {
            setSelected(email) {
                let index = this.selected.indexOf(email);

                if (index !== -1) {
                    Vue.delete(this.selected, index);
                } else {
                    this.selected.push(email);
                }

                this.countRecipients = this.selected.length;
            },
            send() {
                if(this.selected.length > 100) {
                    Swal.fire(
                        'Ошибка',
                        'Максимальное кол-во получателей - 100',
                        'error'
                    );
                    return;
                }

                let formData = new FormData();
                formData.append('message', this.message);
                for(let i=0; i < this.selected.length; i++){
                    formData.append('users[]', this.selected[i])
                }
                if(this.selected.length && this.message) {
                    axios.post('/admin/send-mailing', formData).then(response => {
                        this.message = null;
                        Swal.fire(
                            'Отправленно',
                            `Рассылка успешно отправленна.
                            <a target="_blank" href="/admin/mailing-history/${response.data.mailId}">Детали</a>`,
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
            axios.get('/get-all-cathedra-users-with-email-subscribers').then(response => {
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
