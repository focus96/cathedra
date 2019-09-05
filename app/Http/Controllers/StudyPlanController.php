<?php

namespace App\Http\Controllers;

use App\Models\Specialization;
use App\Models\StudyPlan;
use Illuminate\Http\Request;

class StudyPlanController extends Controller
{
    public function index()
    {
        $studyPlans = StudyPlan::all();
        $specializations = Specialization::all();
        return view('study-plans.index', compact(['studyPlans', 'specializations']));
    }
}
