<?php

namespace App\Admin\Controllers;

use App\Models\CathedraUser;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class CathedraUsersController extends Controller
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
            ->header('Персонал кафедры')
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
        $grid = new Grid(new CathedraUser);

        $grid->id('Ид');
        $grid->column('ФИО')->display(function () {
            return $this->surname.' '.$this->name.' '.$this->last_name;
        });
        $grid->group_id('Группа');
        $grid->branch('Специальность')->display(function ($branch) {
            if($branch === 1){
                return 'АВП';
            }elseif($branch === 2) {
                return 'КI';
            }
        });
        $grid->role('Статус')->display(function ($role) {
            if($role === 1){
                return 'Студент';
            }elseif($role === 2) {
                return 'Преподаватель';
            }elseif(!$role) {
                return 'Полчее';
            }
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
        $show = new Show(CathedraUser::findOrFail($id));

        $show->id('Ид');
        $show->surname('Фамилия');
        $show->name('Имя');
        $show->last_name('Отчество');
        $show->group_id('Группа');
        $show->branch('Специальность')->using([1 => 'АВП', 2 => 'КI']);
        $show->telegram_id('Telegram id');
        $show->role('Статус')->using([1 => 'Студент', 2 => 'Преподаватель']);
        $show->created_at('Запись создана');
        $show->updated_at('Запись обнвлена');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CathedraUser);

        $form->text('name', 'Имя');
        $form->text('surname', 'Фамилия');
        $form->text('last_name', 'Отчество');

        $groups = [
            1 => 'АПП 14-1' ,
            2 => 'Smith',
            3 => 'Kate' ,
        ];
        $form->select('group_id', 'Группа')->options($groups);

        $branches = [
            1 => 'АВП',
            2 => 'КI',
        ];
        $form->select('branch', 'Специальность')->options($branches);

        $form->text('telegram_id', 'Telegram id');

        $roles = [
            1 => 'Студент',
            2 => 'Преподаватель',
            0 => 'Прочее',
        ];
        $form->select('role', 'Статус')->options($roles);

        return $form;
    }
}
