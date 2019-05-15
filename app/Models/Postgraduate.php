<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postgraduate extends Model
{
        protected $fillable = [
        'title',
        'content',
        'image',
        'is_public',
    ];
}
