<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Mail extends Model
{
    const TYPE = 'email';

    protected $attributes = [
        'type' => self::TYPE,
    ];

    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope('type', function (Builder $builder) {
            $builder->where('type', '=', self::TYPE);
        });
    }

    public function recipients()
  	{
    	return $this->hasMany(EmailRecipient::class);
  	}
}
