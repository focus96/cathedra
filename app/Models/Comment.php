<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public function news()
    {
        return $this->hasOne(News::class);
    }

    public function author()
    {
        return $this->hasOne(User::class);
    }
}
