<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use Cviebrock\EloquentSluggable\Sluggable;

class News extends Model
{
    use Sluggable;

    protected $fillable = [
        'title',
        'slug',
        'short',
        'content',
        'image',
        'is_public',
        'views',
        'author_id',
        'publication_date',
    ];
//    public function category()
//    {
//        return $this->hasOne(NewsCategory::class);
//    }
    public function category()
    {
        return $this->belongsToMany(
            NewsCategory::class,
            'news_news_category',
            'news_id',
            'news_category_id'
        );
    }
    public function tags()
    {
        return $this->belongsToMany(
            NewsTag::class,
            'news_news_tag',
            'news_id',
            'news_tag_id'
        );
    }
    public function getImage()
    {
        if ($this->image == null)
        {
            return '/img/no-image.png';
        }


        return '/uploads/' . $this->image;
    }

//    public function author()
//    {
//        return $this->hasOne(User::class);
//    }
    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }
}
