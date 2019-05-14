<?php

namespace App\Admin\Controllers;

use App\Models\StudentPoint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentPointController extends Controller
{
    public function update(Request $request)
    {
        $studentPoint = StudentPoint::find($request->student_point_id);

        if($studentPoint){


            $studentPoint->checkpoint_id = $request->checkpoint_id;
            $studentPoint->student_id = $request->student_id;
            $studentPoint->journal_id = $request->journal_id;
            $studentPoint->checkpoint_id = $request->checkpoint_id;
            $studentPoint->points = $request->value;

            $studentPoint->save();

        }else{

            $studentPoint = new StudentPoint();

            $studentPoint->checkpoint_id = $request->checkpoint_id;
            $studentPoint->student_id = $request->student_id;
            $studentPoint->journal_id = $request->journal_id;
            $studentPoint->checkpoint_id = $request->checkpoint_id;
            $studentPoint->points = $request->value;

            $studentPoint->save();
        }

        return redirect(route('journal', $request->journal_id));
    }
}
