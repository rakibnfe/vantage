<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $users = [
            [
                'name' => 'Admin User',
                'email' => 'admin@gmail.com',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'bio' => 'Full-stack architect with 12+ years of experience building scalable web applications. Passionate about clean code, Vue.js, and helping businesses transform their ideas into digital reality.',
                'profile_picture' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Alex Rivera',
                'email' => 'alex@vantage.dev',
                'password' => Hash::make('password'),
                'role' => 'admin',
                'is_active' => true,
                'bio' => 'Full-stack architect with 12+ years of experience building scalable web applications. Passionate about clean code, Vue.js, and helping businesses transform their ideas into digital reality.',
                'profile_picture' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Maya Chen',
                'email' => 'maya@vantage.dev',
                'password' => Hash::make('password'),
                'role' => 'author',
                'is_active' => true,
                'bio' => 'Frontend specialist and UI/UX enthusiast. Loves creating beautiful, intuitive interfaces that users enjoy. Previously led design systems at several startups.',
                'profile_picture' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'Sarah Johnson',
                'email' => 'sarah@vantage.dev',
                'password' => Hash::make('password'),
                'role' => 'author',
                'is_active' => true,
                'bio' => 'Backend developer and database optimization expert. Loves solving complex problems and building robust APIs. Contributor to several open-source Laravel packages.',
                'profile_picture' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'name' => 'David Okafor',
                'email' => 'david@vantage.dev',
                'password' => Hash::make('password'),
                'role' => 'viewer',
                'is_active' => true,
                'bio' => 'Tech enthusiast and content writer. Helps document our journey and shares insights with the community.',
                'profile_picture' => null,
                'email_verified_at' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        foreach ($users as $user) {
            User::create($user);
        }
    }
}