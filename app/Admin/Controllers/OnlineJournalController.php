<?php

namespace App\Admin\Controllers;

use App\Models\Group;
use App\Models\Items;
use App\Models\OnlineJournal;
use App\Http\Controllers\Controller;
use App\Models\Student;
use App\Models\Teacher;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Widgets\Table;
use function GuzzleHttp\Promise\all;

class OnlineJournalController extends Controller
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
            ->header('Онлайн-журналы')
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
        $grid = new Grid(new OnlineJournal);

        $grid->id('Ид')->display(function ($id) {
            return '<a href="' . route('journal', $id) . '">' . $id . '</a>';
        });
        $grid->item('Предмет')->display(function ($item) {
            return '<a href="' . route('journal', $this->id) . '">' . $item . '</a>';
        });
        $grid->group('Группа');
        $grid->teacher('Преподаватель');
        $grid->is_public('Публичный журнал')->display(function ($isPublic) {
            return $isPublic ? 'Да' : 'Нет';
        });
        $grid->is_close('Активность журнала')->display(function ($isClose) {
            return $isClose ? 'Закрыт' : 'Открыт';
        });
        $grid->model()->orderBy('is_close', 'asc');
        $grid->updated_at('Журнал обновлен');

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
        $show = new Show(OnlineJournal::findOrFail($id));

        $show->id('Ид');
        $show->item('Предмет');
        $show->group('Группа');
        $show->teacher('Преподаватель');
        $show->is_public('Публичный журнал')->using([1 => 'Да', 0 => 'Нет']);
        $show->is_close('Активность журнала')->using([1 => 'Закрыт', 0 => 'Открыт']);
        $show->created_at('Дата создания журнала');
        $show->updated_at('Журнал обновлен');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new OnlineJournal);

        $form->select('item','Предмет')->options(Items::all()->pluck('name', 'name'))->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->select('group','Группа')->options(Group::all()->pluck('name_group', 'id'))->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->select('teacher','Преподаватель')->options(Teacher::all()->pluck('surname', 'surname'))->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);
        $form->switch('is_public', 'Публичный журнал')->default(1);
        $form->switch('is_close', 'Закрыть журнал')->default(0);

        return $form;
    }
}
