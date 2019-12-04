<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class TelegramApplicantsFeedback extends Model
{
    protected $table = 'telegram_applicants_feedback';

    protected $fillable = ['telegram_id', 'question', 'answer', 'is_answered'];
}
