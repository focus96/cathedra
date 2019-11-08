<?php

namespace App\Admin\Controllers;

use App\Models\Specialization;
use App\Models\StudyPlan;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class StudyPlanController extends Controller
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
            ->header('Учеьные планы')
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
            ->header('Просмотр учебного плана')
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
            ->header('Редактрование учебного плана')
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
            ->header('Создание учебного плана')
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
        $grid = new Grid(new StudyPlan);

        $grid->id('Id');
        $grid->level('Курс');
        $grid->year('Год');
        $grid->file('Файл');
        $grid->specialization_id('Специальность')->using(Specialization::all()->pluck('short_name', 'id')->toArray());
        $grid->created_at('Создано');
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
        $show = new Show(StudyPlan::findOrFail($id));

        $show->id('Id');
        $show->level('Курс');
        $show->year('Год');
        $show->file('Файл');
        $show->specialization_id('Специальность')->using(Specialization::all()->pluck('short_name', 'id')->toArray());
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
        $form = new Form(new StudyPlan);

        $form->select('level', 'Курс')
            ->options([1 => 'Первый', 2 => 'Второй', 3 => 'Третий', 4 => 'Четвертый', 5 => 'Пятый'])
            ->rules('required|numeric|in:1,2,3,4,5');
        $form->text('year', 'Год')->rules('required|numeric');;
        $form->file('file', 'Файл')->rules('required|file');
        $form->select('specialization_id', 'Специальность')
            ->options(Specialization::all()->pluck('short_name', 'id'))
            ->rules('required|numeric|exists:specializations,id');;

        return $form;
    }
}
