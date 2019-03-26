<template>
    <div>
        <div class="content">
            <div class="row">
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Пользователи:</h4>
                        </div>
                        <div class="card-body">
                            <div class="users">
                                <div v-for="user in users">
                                    <div class="form-check">
                                        <input type="checkbox" class="form-check-input" :id="'userCheckbox' + user.telegram_id">
                                        <label class="form-check-label" :for="'userCheckbox' + user.telegram_id">{{ user.name }} ({{ user.telegram_id }})</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            <h4>Сообщение:</h4>
                        </div>
                        <div class="card-body">
                            <textarea class="form-control" cols="30" rows="10"
                                      placeholder="Сообщение для рассылки"></textarea>
                            <br>
                            <button class="form-control btn btn-primary">Отправить</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data: () => ({
            users: [
                {
                    name: 'asdas',
                    telegram_id: 1111,
                },
                {
                    name: 'asdas',
                    telegram_id: 2222,
                },
                {
                    name: 'asdas',
                    telegram_id: 3333,
                },
            ]
        }),
        methods: {}
    }
</script>