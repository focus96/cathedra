<?php

namespace App\Http\Controllers;

use App\Exports\Online_journalExport;
use App\Models\Online_journal;
use Maatwebsite\Excel\Facades\Excel;

class SaveXLSController extends Controller
{
    public function save($id)
    {
        $journal = Online_journal::with(['groupRelation.students.points' => function($q) use($id) {
            $q->where('journal_id', $id);
        }, 'checkpoints'])->find($id);

        return Excel::download(new Online_journalExport($journal), 'journal.xls');
    }
}
