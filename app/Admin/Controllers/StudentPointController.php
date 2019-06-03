<?php

namespace App\Admin\Controllers;

use App\Models\CheckPoint;
use App\Models\OnlineJournal;
use App\Models\StudentPoint;
use App\Http\Controllers\Controller;

class StudentPointController extends Controller
{
    public function save(StudentPoint $studentPoint)
    {
        $validStudentPoint = CheckPoint::where('id', request('checkpoint_id'))->first();

        $max_point = $validStudentPoint->max_point;
        $date = $validStudentPoint->date;

        $closeJournal = OnlineJournal::where('id', request('journal_id'))->first();

        if ((int)$closeJournal->is_close === 0){
            $validator = \Validator::make(request()->all(), [
                'points' => 'nullable|numeric|min:0|max:'.$max_point,
                'points_date' => 'after_or_equal:'.$date,
            ]);

            if ($validator->fails())
            {
                return response()->json(['errors'=>$validator->errors()->all()]);
            }else{

                $studentPoint = $studentPoint->find(request('student_point_id'));

                if($studentPoint){

                    $studentPoint->update(request(['checkpoint_id', 'student_id', 'journal_id', 'points']));

                }else{

                    StudentPoint::create(request(['checkpoint_id', 'student_id', 'journal_id', 'points']));

                }
                return response()->json(['success'=>'Сохранение успешно выполнено']);
            }
        }
    }
}
