<?php

namespace App\Http\Controllers;

use App\Models\Album;
use App\Models\Teacher;

class DepartmentCompositionController extends Controller
{
    public function index()
    {
        $teachers = \App\Models\Teacher::where('cathedra_id', 1)->get();
        return View('about-us.department-composition', compact(['teachers']));
    }

    public function show(Teacher $teacher)
    {
        return View('about-us.department-composition-show', compact(['teacher']));
    }
}
