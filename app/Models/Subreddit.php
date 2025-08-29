<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Testing\Fluent\Concerns\Has;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Subreddit extends Model
{
    use HasFactory;
    use HasSlug;
    protected $fillable = [
        'name',
        'created_at',
        'description',
        'type',
        'is_active',
        'image',
        'slug'
    ];
    protected $table = 'subreddits';
    //

    public function posts()
    {
        return $this->HasMany(Post::class);
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }
}
