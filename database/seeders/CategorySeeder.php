<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            [
                'name' => 'Laravel',
                'slug' => 'laravel',
                'description' => 'Deep dives into Laravel development, best practices, and advanced techniques.',
                'color' => '#FF2D20',
                'icon' => 'laravel',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Vue.js',
                'slug' => 'vuejs',
                'description' => 'Modern frontend development with Vue 3, Composition API, and ecosystem tools.',
                'color' => '#42B883',
                'icon' => 'vue',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'PHP',
                'slug' => 'php',
                'description' => 'PHP fundamentals, modern practices, and performance optimization.',
                'color' => '#777BB4',
                'icon' => 'php',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Database',
                'slug' => 'database',
                'description' => 'Database design, optimization, and advanced query techniques.',
                'color' => '#4479A1',
                'icon' => 'database',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'DevOps',
                'slug' => 'devops',
                'description' => 'Deployment strategies, CI/CD, and infrastructure as code.',
                'color' => '#FF6600',
                'icon' => 'devops',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'UX/UI',
                'slug' => 'ux-ui',
                'description' => 'User experience design, interface patterns, and accessibility.',
                'color' => '#61DAFB',
                'icon' => 'design',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Career',
                'slug' => 'career',
                'description' => 'Professional growth, freelancing tips, and tech career advice.',
                'color' => '#E34F26',
                'icon' => 'career',
                'order' => 7,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Tools',
                'slug' => 'tools',
                'description' => 'Developer tools, productivity hacks, and workflow optimization.',
                'color' => '#563D7C',
                'icon' => 'tools',
                'order' => 8,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}