<?php

namespace App\Http\Controllers;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Builder;
use PDF;
use DB;
use App\Models\Group;
use App\Models\Teacher;
use App\Models\Items;
use Illuminate\Http\Request;
use Spatie\Browsershot\Browsershot;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ScheduleExport;

class ScheduleController extends Controller
{
    public function byLectureHall()
    {
        $schedule = Schedule::with(['group', 'teacher', 'item'])->get()->groupBy('lecture_hall');
        $lectureHalls = $schedule->keys();
        return view('schedule/by-lecture-hall', compact(['schedule', 'lectureHalls']));
    }

    public function byGroup()
    {
        $groups = Group::with(['schedule' => function($q) {
            $q->with(['teacher', 'item']);
        }])->get()->keyBy('id');
        $groupsNames = $groups->pluck('name_group', 'id');
        return view('schedule/by-group', compact(['groups', 'groupsNames']));
    }

    public function byTeacher()
    {
        $teachers = Teacher::with(['schedule' => function($q) {
            $q->with(['teacher', 'item']);
        }])->get()->keyBy('id');
        $teacherNames = $teachers->pluck('surname', 'id');
        return view('schedule/by-teacher', compact(['teachers', 'teacherNames']));
    }
}
