<?php

namespace App\Admin\Controllers;

use App\Models\CathedraInfo;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class CathedraInfoControllers extends Controller
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
            ->header('О кафедре')
            ->description('наша кафедра')
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
            ->header('Detail')
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
            ->header('Edit')
            ->description('description')
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
            ->header('Create')
            ->description('description')
            ->body($this->form());
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new CathedraInfo);

        $grid->id('Ид');
        $grid->caption('Заголовок')->sortable();
        $grid->answer('Сообщение');
        $grid->image('Изображение')->display(function ($id) {
            if (isset($id)) {
                
                return '<a href="/storage/uploads/' . $id . '">Просмотреть</a>';
            } else {

                return '-';
            }
        });
        $grid->active('Публичная новость')->display(function ($isPublic) {
            return $isPublic ? 'Да' : 'Нет';
        })->sortable();
        $grid->created_at('Дата создания')->sortable();
        $grid->updated_at('Дата редактирования')->sortable();

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
        $show = new Show(CathedraInfo::findOrFail($id));

        $show->id('Ид');
        $show->caption('Заголовок');
        $show->answer('Сообщение');
        $show->image('Изображение')->image();
        $show->active('Статус');
        $show->created_at('Дата создания');
        $show->updated_at('Дата редактирования');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new CathedraInfo);

        $form->text('caption', 'Заголовок')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->textarea('answer', 'Сообщение')->rules('required|max:2000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->image('image', 'Изображение')->uniqueName()->rules('image', [
            'image' => 'Это должна быть картинка',
        ]);
        $form->switch('active', 'Статус')->default(1);
        $form->saving(function ($form) {
            /* определение числа рядов в выборке */
            $result = CathedraInfo::where('active', '=', 1)->count();
            
            if ($result >= 5 && $form->active === 'on') {
                // redirect back with an error message
                $error = new MessageBag([
                    'title'   => 'Ошибка',
                    'message' => 'Максимальное количество активных записей 5. ',
                ]);

                return redirect('/admin/telegram-bot/applicants/cathedra-info')->with(compact('error'));              
            }
        });

        return $form;       
    }
}
