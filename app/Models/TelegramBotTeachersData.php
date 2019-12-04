<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramBotTeachersData extends Model
{
    protected $fillable = ['parent_id', 'title', 'content'];
}
