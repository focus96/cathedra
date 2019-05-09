<?php

namespace App\Http\Controllers;

use App\Models\Shedule;
use App\Models\Group;
use App\Models\Teacher;

use App\Models\Student;
use Illuminate\Http\Request;

class ScheduleController extends Controller
{
    public function index()
    {
        $shedules = Shedule::orderBy('couple_number','asc')->get();
        $teachers = Teacher::pluck('surname','id')->all();
        $groups = Group::pluck('name_group','id')->all();
                return View('schedule',['shedules' => $shedules,'groups' => $groups,'teachers'=>$teachers]);
    }
}
