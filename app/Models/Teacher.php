<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function getFioAttribute()
    {
        return $this->surname . ' ' . mb_substr($this->name, 0, 1) . '. ' . mb_substr($this->last_name, 0, 1) . '.';
    }
}
