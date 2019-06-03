<?php

namespace App\Admin\Controllers;

use App\Models\UserQuestion;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

use BotMan\BotMan\BotMan;
use BotMan\BotMan\BotManFactory;
use BotMan\BotMan\Drivers\DriverManager;
use BotMan\Drivers\Telegram\TelegramDriver;
use Illuminate\Http\Request;
use BotMan\BotMan\Messages\Attachments\Image;
use BotMan\BotMan\Messages\Outgoing\OutgoingMessage;

class UserQuestionController extends Controller
{
    use HasResourceActions;

    protected $botman;

    protected $config = [
        "telegram" => [
            "token" => '636548977:AAF3TFV6jmYbSUxgyyW3PQbgjhVJ9gb7JUk'
        ]
    ];

    public function __construct()
    {
        DriverManager::loadDriver(TelegramDriver::class);
        $this->botman = BotManFactory::create($this->config);
    }

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Обратная связь')
            ->body($this->grid());
    }

    /**
     * Show interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function show($id, Content $content)
    {
        return $content
            ->header('Информация записи')
            ->body($this->detail($id));
    }

    /**
     * Edit interface.
     *
     * @param mixed $id
     * @param Content $content
     * @return Content
     */
    public function edit($id, Content $content)
    {
        return $content
            ->header('Редактировать')
            ->description('запись')
            ->body($this->form()->edit($id));
    }

    /**
     * Create interface.
     *
     * @param Content $content
     * @return Content
     */
    public function create(Content $content)
    {
        return $content
            ->header('Создать запись')
            ->description('новую')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new UserQuestion);

        $grid->id('Ид');
        $grid->name('Имя пользователя');
        $grid->question('Вопрос');
        $grid->telegram_id('Telegram id');
        $grid->answer('Ответ')->display(function ($answer) {
            if (isset($answer)) {

                return $answer;
            } else {
                return '<a href="/admin/telegram-bot/applicants/feedback/' . $this->id . '/edit">Ответить</a>';
            }
        });
        $grid->created_at('Дата создания');
        $grid->updated_at('Дата редактирования');

        $grid->disableCreateButton();//отключаем кнопку создания записи
        $grid->model()->orderBy('answer', 'asc');//сортировка по наличию ответа

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
        $show = new Show(UserQuestion::findOrFail($id));

        $show->id('Id');
        $show->name('Name');
        $show->question('Question');
        $show->telegram_id('Telegram id');
        $show->answer('Answer');
        $show->created_at('Created at');
        $show->updated_at('Updated at');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new UserQuestion);

        $form->display('name', 'Имя пользователя');
        $form->display('question', 'Вопрос');
        $form->display('telegram_id', 'Telegram id');
        $form->textarea('answer', 'Ответ')->rules('required|max:2000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);

        $form->footer(function ($footer) {
            // disable `View` checkbox
            $footer->disableViewCheck();

            // disable `Continue editing` checkbox
            $footer->disableEditingCheck();

            // disable `Continue Creating` checkbox
            $footer->disableCreatingCheck();
        });

        $form->saved(function ($form) {
            $attachment = "Здравствуйте, " . $form->model()->name . ", касательно Вашего вопроса: " . PHP_EOL . $form->model()->question . PHP_EOL . $form->answer . PHP_EOL . 'Для того, чтобы начать чат с ботом, введите и отправьте команду "/start"';

            $this->botman->say($attachment, $form->model()->telegram_id, TelegramDriver::class);
        });

        return $form;
    }
}
