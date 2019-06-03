<?php

namespace App\Admin\Controllers;

use App\Models\Cathedra;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CathedraController extends Controller
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
            ->header('Список кафедр')
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
        $grid = new Grid(new Cathedra);

        $grid->id('Ид');
        $grid->name('Наименование');
        $grid->abbreviation('Аббревиатура');


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
        $show = new Show(Cathedra::findOrFail($id));

        $show->id('Ид');
        $show->name('Наименование');
        $show->abbreviation('Аббревиатура');
        $show->location('Расположение: корпус, аудитория и тд');
        $show->contacts('Контактные данные: емейл, телефон, факс и тд');
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
        $form = new Form(new Cathedra);

        $form->text('name', 'Наименование кафедры')->rules('required|max:100', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->text('abbreviation','Аббревиатура кафедры')->rules('required|max:10', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->textarea('location','Расположение кафедры: корпус, аудитория и тд')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->textarea('contacts', 'Контактные данные: емейл, телефон, факс и тд')->rules('required|max:500', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);

        return $form;
    }
}
