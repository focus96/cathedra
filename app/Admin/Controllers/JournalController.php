<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CheckPoint;
use App\Models\Group;
use App\Models\OnlineJournal;
use App\Models\Student;
use App\Models\StudentPoint;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Facades\Admin;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;

class JournalController extends Controller
{
    /**
     * @param $id
     * @param Content $content
     * @return Content
     */
    public function index($id, Content $content)
    {
        $journal = OnlineJournal::with(['groupRelation.students.points' => function($q) use($id) {
            $q->where('journal_id', $id);
        }, 'checkpoints'])->find($id);

        return $content->header('Управление журналом')
            ->description(' ')
            ->body(view('admin.online-journal.index', compact( 'journal')));
    }
}
