<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\User;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
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
        $title = fake()->realText(50);
        
        return [
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'thumbnail_url' => fake()->imageUrl,
            'meta_title' => fake()->realText(100),
            'meta_description' => fake()->realText(255),
            'body' => fake()->realText(512),
            'is_published' => fake()->boolean,
            'published_at' => fake()->dateTime,
            'user_id' => User::inRandomOrder()->first()->id,
        ];
    }
}
