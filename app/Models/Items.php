<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    public function cathedras()
    {
        return $this->belongsToMany('App\Models\Cathedra');

    }
}
