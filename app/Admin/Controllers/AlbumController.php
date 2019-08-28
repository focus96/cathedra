<?php

namespace App\Admin\Controllers;

use App\Models\Album;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;

class AlbumController extends Controller
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
            ->header('Альбомы')
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
            ->header('Детали')
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
        $grid = new Grid(new Album);

       // $grid->id('Ид');
        $grid->name('Найменование')->sortable();
        $grid->id('Добавить фото?')->display(function ($id) {
            return '<a href="/admin/media?path=' . urlencode('/albums/' . $id) . '">В альбом</a>';
        });
        $grid->created_at('Создан');
        $grid->updated_at('Обновлен');

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
        $show = new Show(Album::findOrFail($id));

        $show->id('Ид');
        $show->name('Найменование');
        $show->description('Описание');
        $show->cover('Обложка')->image();
        $show->created_at('Создан');
        $show->updated_at('Отредактирован');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Album);

        $form->text('name', 'Найменование')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->textarea('description', 'Описание')->rules('required|max:2000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->image('cover', 'Обложка')->rules('required|image', [
            'required' => 'Обязательно для заполнения',
            'image' => 'Это должна быть картинка',
        ]);

        $form->saved(function (Form $form) {
            $path = storage_path('/app/public/uploads/albums/' . $form->model()->id);
            if(!file_exists($path)) {
                mkdir($path);
            }   
        });

        return $form;
    }
}
