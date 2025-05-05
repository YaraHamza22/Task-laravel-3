<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    protected $fillable=[
        'title',
        'slug',
        'body',
        'is_published',
        'published_date',
        'meta_description',
        'tags'
    ];

    protected $casts=[
        'tags' => 'array',
        'published_date' => 'datetime',
        'is_published' => 'boolean'
    ];
    protected $dates=[
        'published_date'
    ];
}
