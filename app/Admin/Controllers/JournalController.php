<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\OnlineJournal;
use Encore\Admin\Layout\Content;

class JournalController extends Controller
{
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
