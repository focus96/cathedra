<?php

namespace App\Admin\Controllers;

use App\Models\Bachelor;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Illuminate\Support\MessageBag;

class BachelorController extends Controller
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
            ->header('Бакалавр')
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
        $grid = new Grid(new Bachelor);
        $grid->id('Ид');
        $grid->title('Заголовок')->sortable();
        $grid->content('Содежание');
        $grid->image('Изображение')->display(function ($id) {
            if (isset($id)) {
                return '<a href="/admin/media?path=' . urlencode('/uploads/' . $id) . '">Просмотреть</a>';
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
        $show = new Show(Bachelor::findOrFail($id));

        $show->id('Ид');
        $show->title('Заголовк');
        $show->content('Содежание')->unescape();
        $show->image('Иллюстрация')->image();
        $show->is_public('Публичная новсть')->using([1 => 'Да', 0 => 'Нет']);
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Bachelor);

        $form->text('title', 'Заголовок')->rules('required|max:255', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);;
        $form->ckeditor('content', 'Содержание')->rules('required|max:30000', [
            'required' => 'Обязательно для заполнения',
            'max' => 'Кол-во символов не более :max',
        ]);
        $form->image('image', 'Изображение')->rules('required|image', [
            'required' => 'Обязательно для заполнения',
            'image' => 'Это должна быть картинка',
        ]);
        $form->switch('is_public', 'Публичная новсть')->default(1)->rules('required', [
            'required' => 'Обязательно для заполнения',
        ]);


        $form->saved(function (Form $form) {
            $path = storage_path('/app/public/uploads' . $form->model()->id);
            dump($path);
            if(!file_exists($path)) {
                mkdir($path);
            }   
        });

        //подключаемся к бд
        $link = mysqli_connect("localhost", "root", "", "bot");

        /* проверка соединения */
        if (mysqli_connect_errno()) {
            printf("Соединение не удалось: %s\n", mysqli_connect_error());
            exit();
        }

        if ($result = mysqli_query($link, "SELECT * FROM bachelors WHERE is_public = 1")) {

            /* определение числа рядов в выборке */
            if ($row_cnt = mysqli_num_rows($result) >= 5) {
                // redirect back with an error message
                $form->saving(function ($form) {

                    $error = new MessageBag([
                        'title'   => 'Ошибка',
                        'message' => 'Максимальное количество активных записей 5. ',
                    ]);

                    return redirect('/admin/bachelor')->with(compact('error'));
                });
            }
            /* закрытие выборки */
            mysqli_free_result($result);
        }


        return $form;
    }
}
