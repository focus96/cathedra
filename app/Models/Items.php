<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
//    public function cathedras()
//    {
//        return $this->belongsTo('App\Models\Cathedra');
//
//    }
    public function cathedras()
    {
        return $this->belongsTo(Cathedra::class);
    }

}
