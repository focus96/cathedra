<?php

namespace App\Admin\Controllers;

use App\Models\Mail;
use App\Models\Recipient;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class MailController extends Controller
{
    use HasResourceActions;

    /**
     * Index interface.
     *
     * @param Content $content
     * @return Content
     */
    public function index(Content $content)
    {
        return $content
            ->header('Журнал рассылок')
            // ->description('description')
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
            ->header('Подробно')
            // ->description('description')
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
            ->header('Edit')
            ->description('description')
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        return Admin::grid(Mail::class, function (Grid $grid) {
            $grid->id('id')->sortable();
            $grid->message('Текст сообщения');
            // $grid->image('Изображение');
            $grid->image('Изображение')->display(function ($id) {
                if (isset($id)) {
                    return '<a href="/storage/' . urlencode($id) . '">Просмотреть</a>';
                } else {
                    return '-';
                }
            });
            $grid->column('Количество получателей')->display(function (){
                $count = count($this->recipients);
                return "<span class='label label-warning'>{$count}</span>";
            });
            $grid->recipients('Телеграм айди')->display(function ($recipients) {
                $recipients = array_map(function ($recipient) {
                    return "<li>{$recipient['telegram_id']}</li>";
                }, $recipients);

                return join('&nbsp;', $recipients);
            });
            $grid->created_at('Отправлено');
        });

    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Mail::findOrFail($id));

        $show->id('Id');
        $show->message('Текст сообщения');
        $show->created_at('Дата отправки');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Mail);

        $form->textarea('message', 'Сообщение');

        return $form;
    }
}
