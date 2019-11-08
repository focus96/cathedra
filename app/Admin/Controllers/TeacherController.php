<?php

namespace App\Admin\Controllers;

use App\Models\Cathedra;
use App\Models\Group;
use App\Models\Teacher;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TeacherController extends Controller
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
            ->header('Преподаватели')
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
        $grid = new Grid(new Teacher);

        $grid->id('Ид');
        $grid->surname('Фамилия');
        $grid->name('Имя');
        $grid->last_name('Отчество');
        $grid->academic_degree('Ученая степень');
        $grid->function('Должность');
        $grid->cathedra_id('Кафедра')->using(Group::all()->pluck('name', 'id')->toArray());


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
        $show = new Show(Teacher::findOrFail($id));

        $show->id('Ид');
        $show->surname('Фамилия');
        $show->name('Имя');
        $show->last_name('Отчество');
        $show->academic_degree('Ученая степень');
        $show->function('Должность на кафедре');
        $show->additional_information('дополнительная информация ')->unescape();
        $show->specialization('специализация, то есть на чем специализируется этот преподаватель, например на автоматизации или CAD/CAM системах и тд.')->unescape();
        $show->telegram_id('телеграмм ид ');
        $show->email('емейл');
        $show->phone('контактный телефон ');
        $show->publicity_phone('признак публичности телефона, то есть отображать ли его публично для всех')->using([1 => 'Да', 0 => 'Нет']);
        $show->cathedra_id('Кафедра')->using(Group::all()->pluck('name', 'id')->toArray());
//        $show->foto('фото преподавателя ')->image();
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
        $form = new Form(new Teacher);

        $form->text('surname', 'Фамилия')->rules('required|max:50');
        $form->text('name', 'Имя')->rules('required|max:50');
        $form->text('last_name','Отчество')->rules('required|max:100');
        $form->text('academic_degree','Ученая степень')->rules('max:255');
        $form->text('function', 'Должность на кафедре')->rules('max:100');
        $form->ckeditor('additional_information','дополнительная информация ')->rules('max:30000');
        $form->ckeditor('specialization','специализация, то есть на чем специализируется этот преподаватель, например на автоматизации или CAD/CAM системах и тд.')
            ->rules('max:30000');
        $form->text('telegram_id','телеграмм ид ')->rules('nullable|numeric');
        $form->text('email','емейл')->rules('nullable|email');
        $form->text('phone','контактный телефон ')->rules('max:100');
        $form->switch('publicity_phone','признак публичности телефона, то есть отображать ли его публично для всех (0 или 1)')->states([
            'on'  => ['value' => 1, 'text' => 'Да', 'color' => 'success'],
            'off' => ['value' => 0, 'text' => 'Нет'],
        ]);
        $form->select('cathedra_id', 'Кафедра')->options(Cathedra::all()->pluck('name', 'id'))->rules('required');
        $form->image('foto','фото преподавателя ')->move('/app/public/teachers_foto/')->rules('image|max:2000000');

        return $form;
    }
}
