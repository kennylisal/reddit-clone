<?php

namespace Database\Factories;

use App\Models\Subreddit;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Posts>
 */
class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => fake()->sentence(3),
            'content' => fake()->paragraphs(3,true),
            'status' => 'active',
            'subreddit_id' => Subreddit::inRandomOrder()->first()->id,
            'user_id'=> User::inRandomOrder()->first()->id,
            'created_at' => fake()->dateTimeBetween('-30 days','now')
        ];
    }
}
