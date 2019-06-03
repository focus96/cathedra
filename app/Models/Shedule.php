<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Shedule extends Model
{
    public function groups()
    {
        return $this->hasMany('App\Models\Group');

    }
    public function teachers()
    {
        return $this->hasMany('App\Models\Teacher');

    }
}
