<?php

namespace App\Admin\Controllers;

use \App\Models\Feedback;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class FeedbackController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Обратная связь';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Feedback);

        $grid->id('Ид');
        $grid->name('Имя')->sortable();
        $grid->contact('Контакты')->sortable();
        $grid->message('Сообщение');
        $grid->resolve('Отвечен')->display(function ($isPublic) {
            return $isPublic ? 'Да' : 'Нет';
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
        $show = new Show(Feedback::findOrFail($id));

        $show->id('Ид');
        $show->name('Имя');
        $show->contact('Контакты');
        $show->message('Сообщение');
        $show->response('Ответ');
        $show->resolve('Отвечен')->using([1 => 'Да', 0 => 'Нет']);
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
        $form = new Form(new Feedback);

        $form->text('name', 'Имя')->rules('max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);;
        $form->text('contact', 'Контакты')->rules('max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);;
        $form->textarea('message', 'Сообщение')->rules('required', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);;

        $form->textarea('response', 'Ответ');

        $form->switch('resolve','Отвечен')->states([
            'on'  => ['value' => 1, 'text' => 'Да', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'Нет'],
        ]);
        return $form;
    }
}
