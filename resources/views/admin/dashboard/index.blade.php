<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">Количество новостей: <strong>{{ \App\Models\News::count() }}</strong></li>
                <li class="list-group-item">Количество событий: <strong>{{ \App\Models\Event::count() }}</strong></li>
                <li class="list-group-item">Количество подписчиков по email: <strong>{{ \App\Models\EmailSubscriber::count() }}</strong></li>
                <li class="list-group-item">Количество посетителей телеграм-бота: <strong>{{ \App\Models\TelegramBotVisitor::count() }}</strong></li>
                <li class="list-group-item">Количество неотвеченной обратной связи: <strong>{{ \App\Models\Feedback::whereNull('resolve')->count() }}</strong>
                    <a href="/admin/feedback">(ответить)</a></li>
                <li class="list-group-item">Количество неотвеченной обратной связи (телеграмм): </li>
            </ul>
        </div>
        <div class="col-md-6">
            <div id="admin-dashboard">
                <dashboard :settings="{{ json_encode($settings) }}"></dashboard>
            </div>
        </div>
    </div>
</div>

<script src="/js/app.js?t={{ date('H-i-s') }}"></script>
