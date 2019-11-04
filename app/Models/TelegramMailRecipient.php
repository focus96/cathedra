<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TelegramMailRecipient extends Model
{
    protected $casts =[
        'delivered' => 'bool',
    ];

    public function mail()
	{
		return $this->belongsTo('App\Models\Mail');
	}
}
