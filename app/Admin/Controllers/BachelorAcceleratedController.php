<?php

namespace App\Admin\Controllers;

use App\Models\BachelorAccelerated;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class BachelorAcceleratedController extends Controller
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
            ->header('Бакалавр ускор.')
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
            ->header('Просмотр записи')
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
            ->header('Редактирование записи')
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
            ->header('Создание записи')
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
        $grid = new Grid(new BachelorAccelerated);
        $grid->id('Ид');
        $grid->title('Заголовок')->sortable();
        $grid->content('Содежание');
        $grid->image('Изображение')->display(function ($id) {
            if (isset($id)) {

                return '<a href="/storage/uploads/' . urlencode($id) . '">Просмотреть</a>';
            } else {
                return '-';
            }
        });
        $grid->is_public('Публичная новость')->display(function ($isPublic) {
            return $isPublic ? 'Да' : 'Нет';
        })->sortable();

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
        $show = new Show(BachelorAccelerated::findOrFail($id));

        $show->id('Ид');
        $show->title('Заголовк');
        $show->content('Содежание')->unescape();
        $show->image('Иллюстрация')->image();
        $show->is_public('Публичная новoсть')->using([1 => 'Да', 0 => 'Нет']);
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new BachelorAccelerated);

        $form->text('title', 'Заголовок')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);;
        $form->textarea('content', 'Содержание')->rules('required|max:30000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->image('image', 'Изображение')->uniqueName()->rules('image', [
            'image' => 'Это должна быть картинка',
        ]);
        $form->switch('is_public', 'Публичная новсть')->default(1);

        $form->saving(function ($form) {
            $result = BachelorAccelerated::where("is_public", "=", 1)->count();

            /* определение числа рядов в выборке */
            if ($result >= 5 && $form->is_public === 'on') {
                // redirect back with an error message
                $error = new MessageBag([
                    'title'   => 'Ошибка',
                    'message' => 'Максимальное количество активных записей 5. ',
                ]);

                return redirect('/admin/telegram-bot/campaign/bachelor-accelerated')->with(compact('error'));
            }
        });

        return $form;
    }
}
