<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            // Core data first
            UserSeeder::class,
            CategorySeeder::class,
            TagSeeder::class,
            
            // Content that depends on core
            ToolSeeder::class,
            ServiceSeeder::class,
            ProjectSeeder::class,
            ArticleSeeder::class,

            TestimonialSeeder::class,
            
            // Analytics and interactions last
            VisitorSeeder::class,
            ContactSeeder::class,
            ScheduleSeeder::class,
        ]);
    }
}