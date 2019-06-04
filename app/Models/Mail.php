<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    public function recipients()
  	{
    	return $this->hasMany('App\Models\Recipient');
  	}
}
