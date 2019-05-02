<?php

namespace App\Admin\Controllers;

use App\Models\Group;
use App\Models\Shedule;
use App\Http\Controllers\Controller;
use App\Models\Teacher;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SheduleController extends Controller
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
        $grid = new Grid(new Shedule);

        $grid->id('Ид');
        $grid->day('День недели');
        $grid->parity_week('Четность недели')->using(['even' => 'четная', 'odd' => 'нечетная']);
        $grid->couple_number('Номер пары');
        $grid->lecture_hall('Аудитория');
        $grid->group('Группа');
        $grid->teacher('Преподаватель');
        $grid->type_occupation('Тип занятия')->using(['laboratory_work' => 'лабораторная работа', 'practical_lesson' => 'практическое занятие', 'lecture' => 'лекция']);

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
        $show = new Show(Shedule::findOrFail($id));

        $show->id('Ид');
        $show->lecture_hall('Аудитория');
        $show->couple_number('Номер пары');
        $show->group('Группа');
        $show->teacher('Преподаватель');
        $show->parity_week('Четность недели')->using(['even' => 'четная', 'odd' => 'нечетная']);
        $show->day('День недели');
        $show->type_occupation('Тип занятия')->using(['laboratory_work' => 'лабораторная работа', 'practical_lesson' => 'практическое занятие', 'lecture' => 'лекция']);
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
        $form = new Form(new Shedule);

        $form->number('lecture_hall', 'Аудитория')->min(0001)->max(9999)->rules('required|numeric', [
            'required' => 'Обязательно для заполнения',
            'numeric' => 'В поле должно быть число',
        ]);
        $form->number('couple_number','Номер пары')->min(1)->max(5)->rules('required|numeric', [
            'required' => 'Обязательно для заполнения',
            'numeric' => 'В поле должно быть число',
        ]);
        $form->select('group','Группа')->options(Group::all()->pluck('name_group', 'name_group'))->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->select('teacher','Преподаватель')->options(Teacher::all()->pluck('surname', 'surname'))->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->select('parity_week','Четность недели')->options(['even' => 'четная', 'odd' => 'нечетная'])->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->date('day','День недели')->format('dddd')->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->select('type_occupation','Тип занятия')->options(['laboratory_work' => 'лабораторная работа', 'practical_lesson' => 'практическое занятие', 'lecture' => 'лекция'])->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);

        return $form;
    }
}
