<template>
    <div class="admin-mailing-selected-users-box">
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
                <input :disabled="!user.email" type="checkbox" class=""
                       :id="'userCheckbox' + user.email"
                       @change="setSelected(user.email)" :checked="isSelected(user.email)">
                <label class="" :for="'userCheckbox' + user.email">{{
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
            setSelected(email) {
                if (email) {
                    this.$emit('change', email);
                }
            },
            userName(user) {
                let email = user.email ? ' (' + user.email + ')' : '';

                if(this.type === 'teachers') {
                    return user.surname + ' ' + user.name + ' ' + user.last_name + email;
                }else if(this.type === 'students') {
                    return user.surname + ' ' + user.name + ' ' + user.family_name + email;
                }else if(this.type === 'emailSubscribers') {
                    return user.email;
                }
            },
            selectAll() {
                this.isSelectAll = !this.isSelectAll;

                for(let key in this.users) {
                    let email = this.users[key].email;

                    if(email) {
                        let index = this.selectedUsers.indexOf(email);

                        if((index !== -1 && !this.isSelectAll) || (index === -1 && this.isSelectAll)) {
                            this.setSelected(email);
                        }
                    }
                }
            },
            isSelected(email) {
                return this.selectedUsers.indexOf(email) !== -1;
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

    .admin-mailing-selected-users-box label {
        display: inline;
    }
</style>
