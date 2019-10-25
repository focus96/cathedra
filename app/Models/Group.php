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

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function getNameAttribute()
    {
        return trim("{$this->specialization->short_name} {$this->short_year}-{$this->group_number} {$this->levelAbbr}");
    }

    public function getShortYearAttribute()
    {
        return substr($this->admission_year, 2, 3);
    }

    public function getLevelAbbrAttribute()
    {
        $levelAbbrs = [
            'bachelor_acceleration' => '(у)',
            'master' => '(м)',
            'bachelor' => '',
        ];

        return array_key_exists($this->level_education, $levelAbbrs) ? $levelAbbrs[$this->level_education] : '';
    }
}
