<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Subreddit>
 */
class SubredditFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $name = fake()->sentence(3, true);
        $id = rand(1, 300);
        return [
            'name' => fake()->sentence(3, true),
            'description' => fake()->paragraph(2),
            'is_active' => true,
            'created_at' => fake()->dateTime('now'),
            'slug' => \Illuminate\Support\Str::slug($name),
            'image' => 'https://picsum.photos/id/' . $id . '/200/200'
        ];
    }
}
