<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailSubscriber extends Model
{
    protected $fillable = ['email', 'is_confirm'];

    protected $casts = [
        'is_confirm' =>  'bool',
    ];

    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->confirm_token = '12345';
        });
    }



}
