<?php

namespace App\Http\Controllers;

use App\Exports\OnlineJournalExport;
use App\Models\OnlineJournal;
use Maatwebsite\Excel\Facades\Excel;

class SaveXLSController extends Controller
{
    public function save($id)
    {
        $journal = OnlineJournal::with(['groupRelation.students.points' => function($q) use($id) {
            $q->where('journal_id', $id);
        }, 'checkpoints'])->find($id);

        return Excel::download(new OnlineJournalExport($journal), 'journal.xls');
    }
}
