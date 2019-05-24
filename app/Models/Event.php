<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class Event extends Model
{
    use Sluggable;

    protected $fillable = [
        'name',
        'slug',
        'content',
        'cover',
        'start_date',
        'end_date',
        'place',
        'price',
        'organization',
    ];
    public function getImage()
    {
        if ($this->cover == null)
        {
            return '/images/no-image.png';
        }


        return '/uploads/' . $this->cover;
    }

    public function sluggable()
    {
        return [
            'slug' => [
                'source' => 'content'
            ]
        ];
    }
}
