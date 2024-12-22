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
            'Gadgets and Consumer Electronics',
            'Artificial Intelligence and Machine Learning',
            'Cybersecurity and Privacy',
            'Tech Industry News and Trends',
            'Internet and Networking',
            'Artificial Reality and Virtual Reality',
            'Tech Reviews and Comparisons',
            'Emerging Technologies',
            'Tech Tips and Tutorials'
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
