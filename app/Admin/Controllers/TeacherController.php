<?php

namespace App\Admin\Controllers;

use App\Models\Cathedra;
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
        $show->additional_information('дополнительная информация ');
        $show->specialization('специализация, то есть на чем специализируется этот преподаватель, например на автоматизации или CAD/CAM системах и тд.');
        $show->telegram_id('телеграмм ид ');
        $show->email('емейл');
        $show->phone('контактный телефон ');
        $show->publicity_phone('признак публичности телефона, то есть отображать ли его публично для всех (0 или 1)');
        $show->cathedra_id('ид кафедры ');
        $show->foto('фото преподавателя ')->image();
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

        $form->text('surname', 'Фамилия')->rules('required|max:50', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->text('name', 'Имя')->rules('required|max:50', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->text('last_name','Отчество')->rules('required|max:100', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $academic_degree = [
            'Ph.D' => 'Доктор наук',
            'PhD' => 'Кандидат наук',
            'Assistant_professor' => 'Доцент',
            'Professor' => 'Профессор',
        ];
        $form->select('academic_degree','Ученая степень')->options($academic_degree)->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->text('function', 'Должность на кафедре')->rules('required|max:100', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->textarea('additional_information','дополнительная информация ')->rules('required|max:2000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->textarea('specialization','специализация, то есть на чем специализируется этот преподаватель, например на автоматизации или CAD/CAM системах и тд.')->rules('required|max:2000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->number('telegram_id','телеграмм ид ')->rules('required|numeric', [
            'required' => 'Обязательно для заполнения',
            'numeric' => 'В поле должно быть число',
        ]);
        $form->text('email','емейл')->rules('required|email', [
            'required' => 'Обязательно для заполнения',
            'email' => 'Поле должно быть корректным адресом e-mail',
        ]);
        $form->text('phone','контактный телефон ')->rules('required|max:100', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->number('publicity_phone','признак публичности телефона, то есть отображать ли его публично для всех (0 или 1)')->rules('required|numeric', [
            'required' => 'Обязательно для заполнения',
            'numeric' => 'В поле должно быть число',
        ]);
        $form->select('cathedra_id', 'ид кафедры')->options(Cathedra::all()->pluck('name', 'id'))->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);

        $form->image('foto','фото преподавателя ')->move('/app/public/teachers_foto/')->rules('required|image|max:2000000', [
            'required' => 'Обязательно для заполнения',
            'image' => 'Файл должен быть изображением в формате jpeg, png, bmp, gif или svg',
            'max' => 'Размер файла не должен превышать 2 Мб',
        ]);

        return $form;
    }
}
