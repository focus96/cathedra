<?php

namespace App\Http\Controllers;

use App\Models\OnlineJournal;
use Barryvdh\DomPDF\Facade as PDF;

class SavePDFController extends Controller
{
    public function save($id)
    {
        $journal = OnlineJournal::with(['groupRelation.students.points' => function($q) use($id) {
            $q->where('journal_id', $id);
        }, 'checkpoints'])->find($id);

        $pdf = PDF::loadView('online_journals.journal_pdf', compact('journal'));

        return $pdf->download('journal.pdf');
    }
}
