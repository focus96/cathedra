<?php

namespace App\Admin\Controllers;

use App\Models\Items;
use App\Http\Controllers\Controller;
use App\Models\Cathedra;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class ItemController extends Controller
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
            ->header('Список предметов')
            ->description('')
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
            ->description('Редатирование предметов')
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
            ->description('Добавление нового предмета')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Items);

        $grid->id('Id');
        $grid->name('Наименование предмета');
        $grid->abbreviation('Аббревиатура');
        $grid->cathedra_id('Кафедра');
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
        $show = new Show(Items::findOrFail($id));

        $show->id('Id');
        $show->name('Наименование предмета');
        $show->abbreviation('Аббревиатура');
        $show->cathedra_id ('Кафедра');
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
        $form = new Form(new Items);

        $form->text('name', 'Наименование предмета')->rules('required|unique:items|max:255');
        $form->text('abbreviation', 'Аббревиатура')->rules('required|unique:items|max:10');
        $form->select('cathedra_id', 'Кафедра')->options(Cathedra::all()->pluck('name', 'id'))->rules('required');

        return $form;
    }
}
