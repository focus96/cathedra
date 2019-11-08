<?php

namespace App\Admin\Controllers;

use App\Models\Cathedra;
use App\Models\Specialization;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class SpecializationController extends Controller
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
            ->header('Специальности')
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
            ->header('Просмотр специальности')
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
            ->header('Редактирование специальности')
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
            ->header('Создание специальности')
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
        $grid = new Grid(new Specialization);

        $grid->id('Id');
        $grid->full_name('Полное найменование');
        $grid->short_name('Краткое найменование');
        $grid->code('Код специальности');
        $grid->cathedra_id('Кафедра')->using(Cathedra::all()->pluck('abbreviation', 'id')->toArray());
        $grid->created_at('Создано');
        $grid->updated_at('Обновлено');

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
        $show = new Show(Specialization::findOrFail($id));

        $show->id('Id');
        $show->full_name('Полное найменование');
        $show->short_name('Краткое найменование');
        $show->code('Код специальности');
        $show->cathedra_id('Кафедра')->using(Cathedra::all()->pluck('abbreviation', 'id')->toArray());
        $show->created_at('Создано');
        $show->updated_at('Обновлено');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Specialization);

        $form->text('full_name', 'Полное найменование')->rules('required|max:255');
        $form->text('short_name', 'Краткое найменование')->rules('required|max:255');
        $form->text('code', 'Код специальности')->rules('nullable|max:100');
        $form->select('cathedra_id', 'Кафедра')->options(Cathedra::all()->pluck('name', 'id'))
            ->rules('required|numeric|exists:cathedras,id');

        return $form;
    }
}
