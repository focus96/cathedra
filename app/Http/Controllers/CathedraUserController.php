<?php

namespace App\Http\Controllers;

use App\Models\Applicant;
use App\Models\CathedraUser;
use App\Models\EmailSubscriber;
use App\Models\Group;
use App\Models\Teacher;
use Illuminate\Http\Request;

class CathedraUserController extends Controller
{
    public function all()
    {
        $groups = Group::with(['students'])->get()->map(function($group) {
            $group->name = $group->name;
             return $group;
        });

        $teachers = Teacher::all();
        $applicants = Applicant::all();

        return response()->json(compact(['teachers', 'groups', 'applicants']));
    }

    public function allWithEmailSubscribers()
    {
        $groups = Group::with(['students'])->get()->map(function($group) {
            $group->name = $group->name;
            return $group;
        });

        $teachers = Teacher::all();
        $applicants = Applicant::all();
        $emailSubscribers = EmailSubscriber::isConfirm()->get();

        return response()->json(compact(['teachers', 'groups', 'applicants', 'emailSubscribers']));

    }
}
