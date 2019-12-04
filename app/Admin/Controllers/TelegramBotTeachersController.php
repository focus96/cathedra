<?php

namespace App\Admin\Controllers;

use App\Models\EmailSubscriber;
use App\Http\Controllers\Controller;
use App\Models\TelegramBotApplicantsData;
use App\Models\TelegramBotTeachersData;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class TelegramBotTeachersController extends Controller
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
            ->header('Управление бота для преподавателей')
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
            ->header('Просмотр раздела бота для преподавателей')
            ->description('description')
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
            ->header('Редактирование раздела бота для преподавателей')
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
            ->header('Создание раздела бота для преподавателей')
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
        $grid = new Grid(new TelegramBotTeachersData);

        $grid->id('Id');
        $grid->parent_id('Родитель')->sortable();
        $grid->title('Заголовок');
//        $grid->content('Текст');
        $grid->created_at('Создано')->sortable();
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
        $show = new Show(TelegramBotTeachersData::findOrFail($id));

        $show->id('Id');
        $show->parent_id('Родитель');
        $show->title('Заголовок');
        $show->content('Текст');
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
        $form = new Form(new TelegramBotTeachersData);

        $form->text('title', 'Заголовок');
        $form->textarea('content', 'Текст');
        $form->select('parent_id', 'Родитель')->options(TelegramBotTeachersData::all()->pluck('title', 'id'));

        return $form;
    }
}
