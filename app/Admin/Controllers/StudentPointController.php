<?php

namespace App\Admin\Controllers;

use App\Models\CheckPoint;
use App\Models\Online_journal;
use App\Models\StudentPoint;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentPointController extends Controller
{
    public function update(Request $request)
    {
        $validStudentPoint = CheckPoint::where('id', '=', $request->checkpoint_id)->first();
        $max_point = $validStudentPoint->max_point;
        $date = $validStudentPoint->date;

        $closeJournal = Online_journal::where('id', '=', $request->journal_id)->first();

        if ($closeJournal->is_close === 0){
            $validator = \Validator::make($request->all(), [
                'value' => 'nullable|numeric|min:0|max:'.$max_point,
                'points_date' => 'after_or_equal:'.$date,
            ]);

            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }else{
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
                return response()->json(['success'=>'Сохранение успешно выполнено']);
            }
        }
        //return redirect(route('journal', $request->journal_id));
    }
}
