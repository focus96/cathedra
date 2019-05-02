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
            ->header('Index')
            ->description('description')
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
            ->header('Detail')
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
        $grid = new Grid(new Student);

        $grid->id('Id');
        $grid->surname('Фамилия');
        $grid->name('Имя');
        $grid->family_name('Отчество');
        $grid->telegram_id('Telegram-id');
        $grid->email('Email');
        $grid->number('Номер');
        $grid->groups_id('Группа');
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
        $show->number('Номер');
        $show->groups_id('Группа');
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

        $form->text('surname', 'Фамилия')->rules('required|max:50|unique:students', [
            'required' => 'Обязательно для заполнения',
            'unique' => 'Должен быть уникальным',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->text('name', 'Имя')->rules('required|max:50|unique:students', [
            'required' => 'Обязательно для заполнения',
            'unique' => 'Должен быть уникальным',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->text('family_name', 'Отчество')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->number('telegram_id', 'Telegram-id')->rules('unique:students', [
            'unique' => 'Должен быть уникальным',
        ]);
        $form->email('email', 'Email');
//        $form->email('email', 'Email')->rules('unique:students', [
//            'unique' => 'Должен быть уникальным',
//            'email' => 'Поле должно быть типом email'
//        ]);
        $form->text('number', 'Номер')->rules('max:100', [
            'max' => 'Кол-во символов не более :max',
        ]);;
        $form->select('groups_id', 'Группа')->options(Group::all()->pluck('name_group', 'id'));

        return $form;
    }
}
