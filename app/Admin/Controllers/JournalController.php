<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\CheckPoint;
use App\Models\Group;
use App\Models\Online_journal;
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

        $journal = Online_journal::findOrFail($id);
        $group = Group::where('id', '=', $journal->group)->first();
        $students = Student::where('groups_id', '=', $journal->group)->get();
        $checkpoints = CheckPoint::where('journal_id', '=', $journal->id)->get();
        $student_points = StudentPoint::where('journal_id', '=', $journal->id)->get();


        return $content

            // optional
            ->header('Управление журналом')

            ->description(' ')


            // Fill the page body part, you can put any renderable objects here
            ->body(view('admin.online-journal.index', compact('journal', 'group', 'students', 'checkpoints', 'student_points')));

    }
}
