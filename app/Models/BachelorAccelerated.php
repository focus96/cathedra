<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BachelorAccelerated extends Model
{
    protected $table = "bachelorаccelerateds";
    protected $fillable = [
        'title',
        'content',
        'image',
        'is_public',
    ];
}
