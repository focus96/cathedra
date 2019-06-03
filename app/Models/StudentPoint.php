<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StudentPoint extends Model
{
    protected $fillable = [
        'checkpoint_id',
        'student_id',
        'journal_id',
        'points'
    ];
}
