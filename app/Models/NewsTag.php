<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsTag extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

    public function news()
    {
        return $this->belongsToMany(
            News::class,
            'news_news_tag',
            'news_tag_id',
            'news_id'
        );
    }
}
