<?php

namespace App\Admin\Controllers;

use App\Models\Mail;
use App\Http\Controllers\Controller;
use Encore\Admin\Controllers\HasResourceActions;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Content;
use Encore\Admin\Show;
use Encore\Admin\Facades\Admin;

class MailingHistoryController extends Controller
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
            ->header('Журнал рассылок')
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
            ->header('Подробно')
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
            ->body('<div class="text-center"><h3>Редактирование рассылок запрещено (<a href="/admin/mailing-history">список рассылок</a>)</h3></div>');
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
            ->body('<div class="text-center"><h3>Для создания рассылки перейдите в раздел <a href="/admin/mailing">рассылок</a>.</h3></div>');
    }

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {

        return Admin::grid(Mail::class, function (Grid $grid) {
            $grid->id('id')->sortable();
            $grid->message('Текст сообщения');
            // $grid->image('Изображение');
            $grid->image('Изображение')->display(function ($id) {
                if (isset($id)) {
                    return '<a target="_blank" href="/storage/' . urlencode($id) . '">Просмотреть</a>';
                } else {
                    return '-';
                }
            });
            $grid->recipients('Получатели')->display(function ($recipients) {
                $count = count($recipients);

                return "<div style=\"color: green\">Всего получателей: {$count};</div>";
            });
            $grid->created_at('Отправлено');
        });

    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Mail::findOrFail($id));

        $show->id('Id');
        $show->message('Текст сообщения');
        $show->recipients('Получатели')->as(function ($recipients) {
            $count = count($recipients);
            $body = "<div>Всего получателей: {$count}:</div><br>";

            $recipients = array_map(function ($recipient) {
                    return "<div>{$recipient['email']},</div>";
            }, $recipients->toArray());

            return $body . join(' ', $recipients);
        })->unescape();
        $show->created_at('Дата отправки');

        return $show;
    }
}
