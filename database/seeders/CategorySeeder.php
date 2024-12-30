<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Software and App Development',
            'Artificial Intelligence and Machine Learning',
            'Cybersecurity and Privacy',
            'Internet and Networking',
        ];

        foreach ($categories as $category) {
            Category::factory()
                ->hasPosts(5)
                ->create([
                    'title' => $category,
                    'slug' => strtolower(Str::slug($category, '-')),
                ]);
        }
    }
}
