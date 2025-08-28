<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //
    public function index(){
        $posts = Post::with(['author', 'subreddit'])->latest()->take(20)->get();
        return $posts;
    }
}
