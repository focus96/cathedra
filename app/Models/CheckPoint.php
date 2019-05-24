<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CheckPoint extends Model
{
    protected $fillable = [
        'name',
        'max_point',
        'date',
        'deadline',
        'journal_id'
    ];
}
