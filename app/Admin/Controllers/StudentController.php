<?php

namespace App\Admin\Controllers;

use App\Models\Student;
use App\Http\Controllers\Controller;
use App\Models\Group;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class StudentController extends Controller
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
            ->header('Студенты')
            ->description('Список всех студентов')
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
            ->header('Просмотр')
            ->description('')
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
            ->header('Редактирование')
            ->description('')
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
            ->header('Добавление')
            ->description('Добавления нового студента')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Student);

        $grid->id('Id');
        $grid->surname('Фамилия');
        $grid->name('Имя');
        $grid->family_name('Отчество');
        $grid->telegram_id('Telegram-id');
        $grid->email('Email');
        $grid->number('Контактный телефон');
        $grid->groups_id('Группа')->using(Group::all()->pluck('name', 'id')->toArray());
        $grid->created_at('Создание записи');
        $grid->updated_at('Редактирование записи');

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
        $show = new Show(Student::findOrFail($id));

        $show->id('Id');
        $show->surname('Фамилия');
        $show->name('Имя');
        $show->family_name('Отчество');
        $show->telegram_id('Telegram id');
        $show->email('Email');
        $show->number('Контактный телефон');
        $show->groups_id('Группа')->using(Group::all()->pluck('name', 'id')->toArray());
        $show->created_at('Создание записи');
        $show->updated_at('Редактирование записи');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Student);

        $form->text('surname', 'Фамилия')->rules('required|max:50');
        $form->text('name', 'Имя')->rules('required|max:50');
        $form->text('family_name', 'Отчество')->rules('required|max:255');
        $form->text('telegram_id', 'Telegram-id')->rules('nullable');
        $form->email('email', 'Email');
        $form->text('number', 'Контактный телефон')->rules('max:100');;
        $form->select('groups_id', 'Ид группы')->options(Group::all()->pluck('name', 'id'))
            ->rules('required');

        return $form;
    }
}
