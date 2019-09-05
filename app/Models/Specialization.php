<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Specialization extends Model
{
    protected $fillable = ['full_name', 'short_name', 'code', 'cathedra_id'];
}
