<?php

namespace App\Admin\Controllers;

use App\Models\Group;
use App\Http\Controllers\Controller;
use App\Models\Specialization;
use App\Models\Student;
use App\Models\Teacher;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class GroupsController extends Controller
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
            ->header('Группы кафедры')
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
            ->header('Просмотр')
            ->description(' ')
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
            ->header('Создание')
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
        $grid = new Grid(new Group);

        $grid->id('Ид');

        $grid->column('Наименование')->display(function () {
            return $this->name;
        });

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
        $show = new Show(Group::findOrFail($id));

        $show->id('Ид');
        $show->name_group('Наименование группы');
        $show->specialization_id('Специальность')->using(Specialization::all()->pluck('short_name', 'id')->toArray());
        $show->admission_year('Год поступления');
        $show->group_number('Номер группы');
        $show->level_education('Уровень образования')->using(['bachelor' => 'бакалавр', 'bachelor_acceleration' => 'бакалавр ускоренный', 'master' => 'магистр']);
        $show->form_study('Форма обучения')->using(['daytime' => 'дневная', 'correspondence' => 'заочная']);
        $show->curator_id('Ид куратора группы');
        $show->headman_id('Ид старосты группы');
        $show->created_at('Запись создана');
        $show->updated_at('Запись обновлена');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Group);

        $form->select('specialization_id', 'Специальность')->options(Specialization::all()->pluck('short_name', 'id'))->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->number('admission_year', 'Год поступления')->min(2000)->max(2019)->rules('required|numeric', [
            'required' => 'Обязательно для заполнения',
            'numeric' => 'В поле должно быть число',
        ]);
        $form->number('group_number', 'Номер группы')->min(1)->default(1)->rules('required|numeric', [
            'required' => 'Обязательно для заполнения',
            'numeric' => 'В поле должно быть число',
        ]);
        $form->select('level_education', 'Уровень образования')->options(['bachelor' => 'бакалавр', 'bachelor_acceleration' => 'бакалавр ускоренный', 'master' => 'магистр'])->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->select('form_study', 'Форма обучения')->options(['daytime' => 'дневная', 'correspondence' => 'заочная'])->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->select('curator_id', 'Ид куратора группы')->options(Teacher::all()->pluck('surname', 'id'))->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->select('headman_id', 'Ид старосты группы')->options(Student::all()->pluck('surname', 'id'));

        $form->saving(function (Form $form) {
            $form->model()->name_group = 'deprecated';
        });

        return $form;

    }
}
