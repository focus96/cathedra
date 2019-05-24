<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Cathedra extends Model
{
    public function items()
    {
        return $this->HasToMany('App\Models\Items');
    }
}
