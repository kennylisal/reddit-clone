<?php

namespace Database\Seeders;

use App\Models\PostLike;
use App\Models\Post;
use App\Models\Subreddit;
use App\Models\Subscribe;
use App\Models\User;
use Illuminate\Database\Seeder;

class ResetSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        PostLike::query()->delete();
        Post::query()->delete();
        Subreddit::query()->delete();
        User::query()->delete();
        Subscribe::query()->delete();
        //
        User::factory(80)->create();
        Subreddit::factory(28)->create();
        Post::factory(300)->create();
        // PostLikes::factory(150)->create();
        $post_ids = Post::inRandomOrder()->take(100)->pluck('id')->toArray();
        $user_ids = User::inRandomOrder()->take(60)->pluck('id')->toArray();
        foreach($post_ids as $post){
            foreach($user_ids as $user){
                if (rand(0, 1) == 1) {
                    PostLike::create([
                        'created_at' => fake()->dateTimeBetween('-20 days','now'),
                        'user_id' => $user,
                        'post_id' => $post
                    ]);
                }
            }

        }
        //
        $subreddit_ids = Subreddit::inRandomOrder()->pluck('id')->toArray();
        foreach($subreddit_ids as $subreddit){
            foreach($user_ids as $user){
                if (rand(0, 2) == 1){
                    Subscribe::create([
                        'created_at' => fake()->dateTimeBetween('-40 days','now'),
                        'user_id' => $user,
                        'subreddit_id' => $subreddit
                    ]);
                }
            }
        }

    }
}

//php artisan migrate --seed -> ini untuk migrate dan nge-seed
//php artisan db:seed
