<?php

namespace App\Http\Controllers;

use App\Models\Post;

use Illuminate\Support\Facades\DB as FacadesDB;

class PostController extends Controller
{
    //
    public function indexForGuest()
    {
        $posts = Post::with([
            'subreddit' => function ($query) {
                $query->select('id', 'name');
            },
        ])->latest()->take(20)->get();
        return $posts;
    }

    public function indexForUser()
    {
        if (auth()->check()) {
            return redirect()->route('login');
        }
        $subscribedSubredditIds = FacadesDB::table("subscribes")->where('user_id', 686)->pluck('subreddit_id');
        $posts = Post::whereIn('subreddit_id', $subscribedSubredditIds)->with([
            'author' => function ($query) {
                $query->select('id', 'name');
            },

            'subreddit' => function ($query) {
                $query->select('id', 'name');
            }
        ])->latest()->paginate(20);
        return $posts;
    }
}
