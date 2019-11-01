<?php

namespace App\Http\Controllers;

use App\Models\Album;

class ApplicantsController extends Controller
{
    public function index()
    {
        return view('applicants.index');
    }
}
