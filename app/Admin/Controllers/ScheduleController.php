<?php

namespace App\Admin\Controllers;

use App\Models\Group;
use App\Models\Items;
use App\Models\Schedule;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ScheduleController extends Controller
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
            ->header('Расписание')
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
        $grid = new Grid(new Schedule);

        $grid->id('Ид');
        $grid->day('День недели')->using(config('core.dayOfWeek'));
        $grid->parity_week('Четность недели')->using(['even' => 'четная', 'odd' => 'нечетная']);
        $grid->couple_number('Номер пары');
        $grid->lecture_hall('Аудитория');
        $grid->group_id('Группа')->using(Group::all()->pluck('name', 'id')->toArray());
        $grid->teacher_id('Преподаватель')->using(Teacher::all()->pluck('surname', 'id')->toArray());
        $grid->item_id('Предмет')->using(Items::all()->pluck('name', 'id')->toArray());
        $grid->type('Тип занятия')->using(['laboratory_work' => 'лабораторная работа', 'practical_lesson' => 'практическое занятие', 'lecture' => 'лекция']);

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
        $show = new Show(Schedule::findOrFail($id));

        $show->id('Ид');
        $show->lecture_hall('Аудитория');
        $show->couple_number('Номер пары');
        $show->group_id('Группа')->using(Group::all()->pluck('name', 'id')->toArray());
        $show->teacher_id('Преподаватель')->using(Teacher::all()->pluck('surname', 'id')->toArray());
        $show->parity_week('Четность недели')->using(['even' => 'четная', 'odd' => 'нечетная']);
        $show->day('День недели')->using(config('core.dayOfWeek'));
        $show->item_id('Предмет')->using(Items::all()->pluck('name', 'id')->toArray());
        $show->type('Тип занятия')->using(['laboratory_work' => 'лабораторная работа', 'practical_lesson' => 'практическое занятие', 'lecture' => 'лекция']);
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
        $form = new Form(new Schedule);

        $form->text('lecture_hall', 'Аудитория')->rules('required|numeric');
        $form->text('couple_number','Номер пары')->rules('required|numeric');
        $form->select('group_id','Группа')->options(Group::all()->pluck('name', 'id'))->rules('required');
        $form->select('teacher_id','Преподаватель')->options(Teacher::all()->pluck('surname', 'id'))->rules('required');
        $form->select('parity_week','Четность недели')->options(['even' => 'четная', 'odd' => 'нечетная']);
        $form->select('day','День недели')->options(config('core.dayOfWeek'))->rules('required');
        $form->select('item_id','Предмет')->options(Items::all()->pluck('name', 'id'))->rules('required');
        $form->select('type','Тип занятия')->options(['laboratory_work' => 'лабораторная работа', 'practical_lesson' => 'практическое занятие', 'lecture' => 'лекция'])->rules('required');

        return $form;
    }
}
