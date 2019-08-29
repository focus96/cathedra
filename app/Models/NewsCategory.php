<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewsCategory extends Model
{
    public $timestamps = false;

    protected $fillable = [
        'name'
    ];

//    public function news()
//    {
//        return $this->hasMany(News::class);
//    }
    public function news()
    {
        return $this->belongsToMany(
            News::class,
            'news_news_category',
            'news_category_id',
            'news_id'
        );
    }
}
