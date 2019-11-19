<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EmailRecipient extends Model
{
    public function mail()
	{
		return $this->belongsTo(Mail::class);
	}
}
