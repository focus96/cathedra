<?php

namespace App\Http\Requests;

use App\Models\StudentPoint;
use Illuminate\Foundation\Http\FormRequest;

class StudentPointRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(StudentPoint $studentPoint)
    {

        $validStudentPoint = CheckPoint::where('id', request('checkpoint_id'))->first();

        $max_point = $validStudentPoint->max_point;
        $date = $validStudentPoint->date;

        return [
            'points' => 'nullable|numeric|min:0|max:'.$max_point,
            'points_date' => 'after_or_equal:'.$date,
        ];
    }
}
