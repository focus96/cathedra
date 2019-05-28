<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipient extends Model
{
    public function mail()
	{
		return $this->belongsTo('App\Models\Mail');
	}
}
