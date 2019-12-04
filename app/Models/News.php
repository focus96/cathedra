<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class News extends Model
{
    protected $fillable = ['title', 'slug', 'short', 'content', 'image', 'is_public', 'views', 'author_id', 'publication_date',];

    public function categories()
    {
        return $this->belongsToMany(NewsCategory::class, 'news_news_category', 'news_id', 'news_category_id');
    }

    public function tags()
    {
        return $this->belongsToMany(NewsTag::class, 'news_news_tag', 'news_id', 'news_tag_id');
    }

    public function scopeSearch($query)
    {
        $categories = array_filter(explode('_', request()->get('categories', null)));
        $tags = array_filter(explode('_', request()->get('tags', null)));
        $search = request()->get('search', null);

        $query->where(function ($query) use($categories, $tags) {
            if (count($categories)) {
                $query->orWhereHas('categories', function ($query) use ($categories) {
                    $query->whereIn('news_categories.id', $categories);
                });
            }

            if (count($tags)) {
                $query->orWhereHas('tags', function ($query) use ($tags) {
                    $query->whereIn('news_tags.id', $tags);
                });
            }
        });

        if ($search) {
            $query->where(function ($query) use($search) {
                $query->orWhere('title', 'like', '%' . $search . '%');
                $query->orWhere('short', 'like', '%' . $search . '%');
                $query->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        return $query;
    }

    public function scopeBeforePublicationDate($query)
    {
        return $query->where('publication_date', '<=', Carbon::now()->format('Y-m-d H:i:s'));
    }
}
