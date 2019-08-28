<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public function students()
    {
        return $this->hasMany(Student::class, 'groups_id');
    }

    public function schedule()
    {
        return $this->hasMany(Schedule::class);
    }

    public function curator()
    {
        return $this->belongsTo(Teacher::class, 'curator_id', 'id');
    }
}
