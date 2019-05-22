<?php

namespace App\Http\Controllers;

use App\Models\Shedule;
use App\Models\Teacher;

class TeacherController extends Controller
{
    public function index()
    {
        $shedules = Shedule::orderBy('couple_number','asc')->get();
        $teachers = Teacher::pluck('surname','id')->all();

        return View('schedule/teacher',['shedules' => $shedules,'teachers'=>$teachers]);
    }
}
