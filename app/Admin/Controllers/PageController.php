<?php

namespace App\Admin\Controllers;

use \App\Models\Feedback;
use App\Models\Page;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class PageController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Менеджер страниц';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Page);

        $grid->id('Ид');
        $grid->name('Имя')->sortable();
        $grid->code('Код')->sortable();
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
        $show = new Show(Page::findOrFail($id));

        $show->id('Ид');
        $show->name('Имя');
        $show->code('Код');
        $show->content('Контент')->unescape();
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
        $form = new Form(new Page);

        $form->text('code', 'Код')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);

        $form->text('name', 'Имя')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);

        $form->ckeditor('content', 'Контент')->rules('required|max:50000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);

        return $form;

    }
}
