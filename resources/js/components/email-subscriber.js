let emailMixin = {
    data: () => ({
        status: null,
        isConfirm: null,
        email: null,
        error: null,
        resendSuccess: null,
    }),
    methods: {
        subscribe() {
            axios.post(`/subscribe`, {
                email: this.email
            }).then(response => {
                this.status = response.data.status;
                this.isConfirm = response.data.is_confirm;
                this.error = null;
            }).catch(error => {
                this.status = 'error';
                this.error = error.response.data.errors && error.response.data.errors.email ? error.response.data.errors.email[0] : [];
            });
        },
        resend() {
            axios.post(`/resend-confirm-subscribe-email`, {
                email: this.email
            }).then(response => {
                this.resendSuccess = true;
            }).catch(error => {
                this.resendSuccess = false;
            });
        }
    }
}

const emailSubscriberNewsSidebar = new Vue({
    el: '#email-subscriber-news-sidebar',
    mixins: [emailMixin],
});

const emailSubscriberFooter = new Vue({
    el: '#email-subscriber-footer',
    mixins: [emailMixin],
});