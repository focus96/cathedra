<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Online_journal extends Model
{
    public function groupRelation() {
        return $this->belongsTo(Group::class, 'group');
    }

    public function checkpoints()
    {
        return $this->hasMany(CheckPoint::class, 'journal_id');
    }
}
