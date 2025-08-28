<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subreddit extends Model
{
    use HasFactory;
    protected $fillable=[
        'name','created_at','description','type','is_active'
    ];
    protected $table = 'subreddits';
    //

    public function posts(){
        return $this->HasMany(Post::class);
    }

}
