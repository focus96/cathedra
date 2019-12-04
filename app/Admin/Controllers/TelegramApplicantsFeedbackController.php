<?php

namespace App\Admin\Controllers;

use \App\Models\Feedback;
use App\Models\TelegramApplicantsFeedback;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class TelegramApplicantsFeedbackController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Обратная связь бота для аббитуриентов';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new TelegramApplicantsFeedback());

        $grid->id('Ид');
        $grid->telegram_id('Телеграм ид')->sortable();
        $grid->question('Вопрос')->sortable();
        $grid->answer('Ответ');
        $grid->is_answered('Отвечен')->display(function ($isAnswered) {
            $link = '';
            if($this->answer) {
                $link = "<a href='/admin/telegram-bot/applicants/feedback/send/{$this->id}'> Отправить</a>";
            }

            return $isAnswered ? 'Да' : 'Нет' . $link;
        })->sortable();
        $grid->created_at('Дата создания')->sortable();
        $grid->updated_at('Дата редактирования')->sortable();

        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(TelegramApplicantsFeedback::findOrFail($id));

        $show->id('Ид');
        $show->telegram_id('Телеграм ид');
        $show->question('Вопрос');
        $show->answer('Ответ');
        $show->is_answered('Отвечен')->using([1 => 'Да', 0 => 'Нет']);
        $show->created_at('Дата создания');
        $show->updated_at('Дата последнего редактирования');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new TelegramApplicantsFeedback);

        $form->textarea('question', 'Вопрос')->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);;
        $form->textarea('answer', 'Ответ');

        return $form;
    }

    public function send(TelegramApplicantsFeedback $feedback)
    {
        $config = [
            "telegram" => config('bot.telegram.applicants')
        ];

        DriverManager::loadDriver(TelegramDriver::class);
        $botman = BotManFactory::create($config);

        $attachment = "Привет, касательно твоего вопроса: " .  PHP_EOL .
            '"' . $feedback->question . '"' . PHP_EOL . PHP_EOL .
            $feedback->answer .  PHP_EOL . PHP_EOL .
            "С найлучшими пожеланиями, кафедра АВП";

        $botman->say($attachment, $feedback->telegram_id, TelegramDriver::class);

        $feedback->is_answered = 1;
        $feedback->save();

        return redirect()->back();
    }
}
