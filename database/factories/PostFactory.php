<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

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
        $title = fake()->words(3, true);
        return [
            'title' => $title,
            'slug' => Str::slug($title, '-'),
            'is_published' => true,
            'body' => fake()->paragraphs(3, true),
            'user_id' => rand(1,5)
        ];
    }
}
