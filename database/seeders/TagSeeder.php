<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        $tags = [
            // Laravel Tags
            ['name' => 'Eloquent', 'slug' => 'eloquent', 'color' => '#FF2D20', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laravel 11', 'slug' => 'laravel-11', 'color' => '#FF2D20', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Laravel 12', 'slug' => 'laravel-12', 'color' => '#FF2D20', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'API Development', 'slug' => 'api-development', 'color' => '#4CAF50', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Authentication', 'slug' => 'authentication', 'color' => '#2196F3', 'created_at' => now(), 'updated_at' => now()],
            
            // Vue.js Tags
            ['name' => 'Vue 3', 'slug' => 'vue-3', 'color' => '#42B883', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Composition API', 'slug' => 'composition-api', 'color' => '#42B883', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Pinia', 'slug' => 'pinia', 'color' => '#F7D44C', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vue Router', 'slug' => 'vue-router', 'color' => '#42B883', 'created_at' => now(), 'updated_at' => now()],
            
            // Database Tags
            ['name' => 'MySQL', 'slug' => 'mysql', 'color' => '#4479A1', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PostgreSQL', 'slug' => 'postgresql', 'color' => '#336791', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Performance', 'slug' => 'performance', 'color' => '#E44D26', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Optimization', 'slug' => 'optimization', 'color' => '#FF9800', 'created_at' => now(), 'updated_at' => now()],
            
            // DevOps Tags
            ['name' => 'Docker', 'slug' => 'docker', 'color' => '#2496ED', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'CI/CD', 'slug' => 'cicd', 'color' => '#4285F4', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'AWS', 'slug' => 'aws', 'color' => '#FF9900', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Forge', 'slug' => 'forge', 'color' => '#8A2BE2', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Vapor', 'slug' => 'vapor', 'color' => '#00758F', 'created_at' => now(), 'updated_at' => now()],
            
            // Frontend Tags
            ['name' => 'Tailwind CSS', 'slug' => 'tailwind-css', 'color' => '#38B2AC', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Alpine.js', 'slug' => 'alpinejs', 'color' => '#8BC0D0', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Inertia', 'slug' => 'inertia', 'color' => '#9553E9', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Livewire', 'slug' => 'livewire', 'color' => '#FB70A9', 'created_at' => now(), 'updated_at' => now()],
            
            // Testing Tags
            ['name' => 'Pest', 'slug' => 'pest', 'color' => '#C51162', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'PHPUnit', 'slug' => 'phpunit', 'color' => '#366488', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'TDD', 'slug' => 'tdd', 'color' => '#E34F26', 'created_at' => now(), 'updated_at' => now()],
            
            // Tutorial Tags
            ['name' => 'Tutorial', 'slug' => 'tutorial', 'color' => '#4CAF50', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Beginner', 'slug' => 'beginner', 'color' => '#8BC34A', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Advanced', 'slug' => 'advanced', 'color' => '#F44336', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Tips & Tricks', 'slug' => 'tips-tricks', 'color' => '#FFC107', 'created_at' => now(), 'updated_at' => now()],
            
            // General
            ['name' => 'Open Source', 'slug' => 'open-source', 'color' => '#000000', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Security', 'slug' => 'security', 'color' => '#DC3545', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Best Practices', 'slug' => 'best-practices', 'color' => '#28A745', 'created_at' => now(), 'updated_at' => now()],
            ['name' => 'Refactoring', 'slug' => 'refactoring', 'color' => '#6F42C1', 'created_at' => now(), 'updated_at' => now()],
        ];

        foreach ($tags as $tag) {
            Tag::create($tag);
        }
    }
}