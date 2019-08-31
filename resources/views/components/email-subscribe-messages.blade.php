<div style="display: none" v-show="status === 'created'" class="green">
    <span>Подписка офорлена успешно! Вам выслано письмо, пожалуйста, подтвердите свой email</span>
</div>
<div style="display: none" v-show="status === 'error'" class="red">{{ vue('error') }}</div>
<div style="display: none" v-show="status === 'already_exists'" class="red">
    <div>Подписка на этот email уже оформлена</div>
    <div v-if="isConfirm">Email подтвержден, чтобы отписать обратитесь к администрации</div>
    <div v-if="!isConfirm && !resendSuccess">Email не подтвежден, <a href="javascript:;" @click="resend()">повторно выслать письмо</a></div>
    <div class="green" v-if="resendSuccess">Письмо успешно отправлено</div>
</div>