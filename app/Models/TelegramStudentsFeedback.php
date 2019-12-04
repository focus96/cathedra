<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class TelegramStudentsFeedback extends Model
{
    protected $table = 'telegram_students_feedback';

    protected $fillable = ['telegram_id', 'question', 'answer', 'is_answered'];
}
