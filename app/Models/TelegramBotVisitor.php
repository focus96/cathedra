<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramBotVisitor extends Model
{
    protected $fillable = ['bot_type', 'telegram_id', 'user_name', 'first_name', 'last_name'];
}
