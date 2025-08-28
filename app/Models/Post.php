<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /** @use HasFactory<\Database\Factories\PostsFactory> */
    use HasFactory;
    protected $fillable=[
        'title','content','comment_num','like_num','created_at','status','subreddit_id','user_id'
    ];
    protected $table = 'posts';

    public function author(){
        return $this->belongsTo(User::class, 'user_id');
    }

    public function subreddit(){
        return $this->belongsTo(Subreddit::class);
    }
}
