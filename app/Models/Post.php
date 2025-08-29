<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostsFactory> */
    use HasFactory;
    use HasSlug;
    protected $fillable = [
        'title',
        'content',
        'comment_num',
        'like_num',
        'created_at',
        'status',
        'subreddit_id',
        'user_id',
        'image',
        'slug'
    ];
    protected $table = 'posts';

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subreddit()
    {
        return $this->belongsTo(Subreddit::class);
    }
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
