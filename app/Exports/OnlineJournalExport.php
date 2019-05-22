<?php

namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class OnlineJournalExport implements FromView
{
    public $journal;

    public function __construct($journal)
    {
        $this->journal = $journal;
    }

    public function view(): View
    {
        return view('online_journals.journal_xls', [
            'journal' => $this->journal
        ]);
    }
}