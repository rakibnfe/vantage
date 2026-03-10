<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\{Article, User, Category, Tag};

class ArticleSeeder extends Seeder
{
    public function run(): void
    {
        $authors = User::whereIn('role', ['admin', 'author'])->pluck('id');
        $categories = Category::pluck('id');
        $tags = Tag::pluck('id');

        $articles = [
            [
                'title' => 'Building Modern Web Apps with Laravel 12 and Vue 3: A Complete Guide',
                'slug' => 'building-modern-web-apps-laravel-12-vue-3-complete-guide',
                'excerpt' => 'Explore the powerful combination of Laravel 12 and Vue 3 for building full-stack applications with Inertia.js.',
                'content' => 'Building modern apps using Laravel 12, Vue 3 and Inertia.js provides a powerful full-stack experience. This stack enables SPA-like UX without a traditional API while keeping Laravel routing and controllers.',
                'reading_time' => 12,
                'is_published' => true,
                'published_at' => now()->subDays(15),
                'meta_title' => 'Building Modern Web Apps with Laravel 12 and Vue 3',
                'meta_description' => 'Learn how to build modern applications with Laravel 12, Vue 3 and Inertia.',
                'created_at' => now()->subDays(20),
                'updated_at' => now()->subDays(15),
            ],
            [
                'title' => 'Mastering Eloquent: Advanced Query Techniques',
                'slug' => 'mastering-eloquent-advanced-query-techniques',
                'excerpt' => 'Advanced Laravel Eloquent techniques for efficient and optimized queries.',
                'content' => 'Eloquent can handle complex database operations elegantly. Techniques like subqueries, eager loading and chunk processing help scale large applications.',
                'reading_time' => 15,
                'is_published' => true,
                'published_at' => now()->subDays(8),
                'meta_title' => 'Advanced Eloquent Query Techniques',
                'meta_description' => 'Master advanced Laravel Eloquent techniques.',
                'created_at' => now()->subDays(12),
                'updated_at' => now()->subDays(8),
            ],
            [
                'title' => 'Vue 3 Composition API: Practical Guide',
                'slug' => 'vue-3-composition-api-practical-guide',
                'excerpt' => 'Learn how to effectively use Vue 3 Composition API in real-world apps.',
                'content' => 'The Composition API provides better logic reuse and improved structure compared to Options API, making large Vue apps easier to maintain.',
                'reading_time' => 10,
                'is_published' => true,
                'published_at' => now()->subDays(3),
                'meta_title' => 'Vue 3 Composition API Guide',
                'meta_description' => 'Practical guide to Vue 3 Composition API.',
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(3),
            ],
            [
                'title' => 'Database Optimization: 10 Techniques',
                'slug' => 'database-optimization-10-techniques',
                'excerpt' => 'Proven techniques to improve database performance in Laravel.',
                'content' => 'Indexing, eager loading, caching, batching and monitoring slow queries are essential techniques for optimizing database performance.',
                'reading_time' => 8,
                'is_published' => true,
                'published_at' => now()->subDay(),
                'meta_title' => 'Database Optimization Techniques',
                'meta_description' => 'Improve Laravel database performance with these techniques.',
                'created_at' => now()->subDays(2),
                'updated_at' => now()->subDay(),
            ],
            [
                'title' => 'From Junior to Senior: Developer Lessons',
                'slug' => 'junior-to-senior-lessons-learned',
                'excerpt' => 'Key lessons learned during a decade of software development.',
                'content' => 'Great developers focus on communication, understanding business problems, writing maintainable code and continuous learning.',
                'reading_time' => 7,
                'is_published' => true,
                'published_at' => now()->addDays(2),
                'meta_title' => 'Junior to Senior Developer Journey',
                'meta_description' => 'Lessons from 10 years of development experience.',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($articles as $data) {
            $article = Article::create([
                ...$data,
                'user_id' => $authors->random(),
                'category_id' => $categories->random(),
            ]);

            $article->tags()->attach(
                $tags->random(rand(3, 7))->values()->all()
            );
        }
    }
}