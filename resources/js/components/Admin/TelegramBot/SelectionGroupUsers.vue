<template>
    <div>
        <div>
            <div class="form-check">
                <input :disabled="users && !users.length" type="checkbox"
                       class="form-check-input" :id="group"
                       @change="selectAll()" :checked="isSelectAll">
                <label class="form-check-label" :for="group">{{ titleGroup }}</label>
            </div>
        </div>
        <div class="inside-users" v-for="user in users">
            <div class="form-check">
                <input :disabled="!user.telegram_id" type="checkbox" class=""
                       :id="'userCheckbox' + user.telegram_id"
                       @change="setSelected(user.telegram_id)" :checked="isSelected(user.telegram_id)">
                <label class="" :for="'userCheckbox' + user.telegram_id">{{
                    userName(user) }}</label>
            </div>
        </div>
        <div v-if="!users.length">
            <div class="form-check">
                <span style="margin-left: 25px">Пользователей не найдено</span>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            isSelectAll: false
        }),
        props: ['users', 'group', 'titleGroup', 'selectedUsers', 'type'],
        methods: {
            setSelected(telegramId) {
                if (telegramId) {
                    this.$emit('change', telegramId);
                }
            },
            userName(user) {
                let telegramPart = user.telegram_id ? ' (' + user.telegram_id + ')' : '';

                if(this.type === 'applicants') {
                    return  user.name + ' / ' + user.telegram_name+ telegramPart;
                }else if(this.type === 'teachers') {
                    return user.surname + ' ' + user.name + ' ' + user.last_name + telegramPart;
                }else if(this.type === 'students') {
                    return user.surname + ' ' + user.name + ' ' + user.family_name + telegramPart;
                }
            },
            selectAll() {
                this.isSelectAll = !this.isSelectAll;

                for(let key in this.users) {
                    let telegramId = this.users[key].telegram_id;

                    if(telegramId) {
                        let index = this.selectedUsers.indexOf(telegramId);

                        if((index !== -1 && !this.isSelectAll) || (index === -1 && this.isSelectAll)) {
                            this.setSelected(telegramId);
                        }
                    }
                }
            },
            isSelected(telegramId) {
                return this.selectedUsers.indexOf(telegramId) !== -1;
            }
        },
        created() {

        }
    }
</script>

<style>
    .inside-users {
        margin-left: 20px;
    }
</style>