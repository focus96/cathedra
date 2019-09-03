<?php

namespace App\Admin\Controllers;

use App\Models\EmailSubscriber;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class EmailSubscriberController extends Controller
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
            ->header('Управление подписчиками по email')
            ->description(' ')
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
            ->header('Просмотр подписчика по email')
            ->description('description')
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
            ->header('Редактирование подписчика по email')
            ->description(' ')
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
            ->header('Создание подписчика по email')
            ->description(' ')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new EmailSubscriber);

        $grid->id('Id');
        $grid->email('Email')->sortable();
        $grid->confirm_token('Токен подтверждения');
        $grid->is_confirm('Подтвержен ли email')->display(function ($isConfirm) {
            return $isConfirm ? 'Да' : 'Нет';
        })->sortable();;
        $grid->created_at('Создано')->sortable();
        $grid->updated_at('Отредактировано');

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
        $show = new Show(EmailSubscriber::findOrFail($id));

        $show->id('Id');
        $show->email('Email');
        $show->confirm_token('Токен подтверждения');
        $show->created_at('Создано');
        $show->updated_at('Отредактировано');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new EmailSubscriber);

        $form->email('email', 'Email');
        $form->text('confirm_token', 'Токен подтверждения');
        $form->switch('is_confirm', 'Подтвержен ли email');

        return $form;
    }
}
