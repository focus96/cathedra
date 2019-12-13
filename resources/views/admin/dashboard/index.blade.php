<div class="container-fluid">
    <div class="row">
        <div class="col-md-6">
            <ul class="list-group">
                <li class="list-group-item">Количество новостей: <strong>{{ \App\Models\News::count() }}</strong></li>
                <li class="list-group-item">Количество событий: <strong>{{ \App\Models\Event::count() }}</strong></li>
                <li class="list-group-item">Количество подписчиков по email:
                    <strong>{{ \App\Models\EmailSubscriber::count() }}</strong></li>
                <li class="list-group-item">Количество посетителей телеграм-бота:
                    <strong>{{ \App\Models\TelegramBotVisitor::count() }}</strong></li>
                <li class="list-group-item">Количество неотвеченной обратной связи:
                    @php
                        $feedbackCount = \App\Models\Feedback::whereNull('resolve')->count();
                    @endphp
                    <strong>{{ $feedbackCount }}</strong>
                    @if($feedbackCount)
                        <a href="/admin/feedback">(ответить)</a></li>
                    @endif
                <li class="list-group-item">Количество неотвеченной обратной связи (телеграмм, бот для аббитуриентов):
                    @php
                        $feedbackACount = \App\Models\TelegramApplicantsFeedback::where('is_answered', 0)->count();
                    @endphp
                    <strong>{{ $feedbackACount }}</strong>
                    @if($feedbackACount)
                        <a href="/admin/telegram-bot/applicants/feedback">(ответить)</a>
                    @endif
                </li>
                <li class="list-group-item">Количество неотвеченной обратной связи (телеграмм, бот для студентов):
                    @php
                        $feedbackSCount = \App\Models\TelegramStudentsFeedback::where('is_answered', 0)->count();
                    @endphp
                    <strong>{{ $feedbackSCount }}</strong>
                    @if($feedbackSCount)
                        <a href="/admin/telegram-bot/students/feedback">(ответить)</a>
                    @endif
                </li>
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
