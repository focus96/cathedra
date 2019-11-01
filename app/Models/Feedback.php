<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Feedback extends Model
{
    protected $fillable = [
        'name',
        'contact',
        'email',
        'message',
        'response',
        'resolve',
    ];


}
