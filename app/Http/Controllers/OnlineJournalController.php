<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\OnlineJournal;

class OnlineJournalController extends Controller
{
    public function index()
    {
        $groups = Group::all();

        return view('online_journals.index', compact( 'groups'));
    }

    public function show_journal($id)
    {
        $journal = OnlineJournal::with(['groupRelation.students.points' => function($q) use($id) {
            $q->where('journal_id', $id);
        }, 'checkpoints'])->find($id);

        return view('online_journals.show_journal', compact( 'journal'));
    }

    public function show_group($id)
    {
        $group = Group::find($id);
        $online_journals = OnlineJournal::where('group', $id)->get();

        return view('online_journals.show_group', compact( 'group', 'online_journals'));
    }
}
