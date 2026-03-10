<?php

namespace Database\Seeders;

use App\Models\Project;
use App\Models\User;
use App\Models\Service;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    public function run(): void
    {
        $admin = User::where('role', 'admin')->first();
        $services = Service::all();
        $tags = Tag::all();

        // Get specific tags
        $laravelTag = Tag::where('slug', 'laravel-12')->first();
        $vueTag = Tag::where('slug', 'vue-3')->first();
        $mysqlTag = Tag::where('slug', 'mysql')->first();
        $dockerTag = Tag::where('slug', 'docker')->first();

        $projects = [
            [
                'user_id' => $admin->id,
                'title' => 'FinTech Dashboard - Wealth Management Platform',
                'slug' => 'fintech-dashboard-wealth-management',
                'description' => 'A comprehensive wealth management dashboard for financial advisors and their clients.',
                'overview' => 'This platform enables financial advisors to manage client portfolios, track investments, and generate performance reports. Clients get a simplified view of their investments with real-time updates.',
                'challenge' => 'The client needed a secure, real-time dashboard that could handle complex financial calculations while maintaining strict security and compliance standards. The platform had to be intuitive enough for clients while providing deep analytical tools for advisors.',
                'solution' => 'We built a Laravel-powered API with Vue.js frontend, implementing real-time updates via WebSockets. Used encryption for sensitive data and built a role-based permission system. Created interactive charts with D3.js for portfolio visualization.',
                'results' => 'The platform now serves 200+ financial advisors and 5,000+ clients. Portfolio analysis time reduced by 70%. Client engagement increased by 150% with the mobile-responsive dashboard.',
                'technologies' => json_encode(['Laravel 12', 'Vue 3', 'MySQL', 'Redis', 'D3.js', 'WebSockets', 'Tailwind CSS']),
                'live_url' => 'https://wealth-demo.vantage.dev',
                'github_url' => null,
                'case_study_url' => '/case-studies/fintech-dashboard',
                'start_date' => '2025-03-15',
                'end_date' => '2025-09-20',
                'status' => 'completed',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => '2025-10-01',
                'order' => 1,
                'meta_title' => 'FinTech Dashboard Case Study - Wealth Management Platform',
                'meta_description' => 'How we built a secure wealth management platform for financial advisors and their clients using Laravel and Vue.js.',
                'created_at' => now()->subMonths(8),
                'updated_at' => now(),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'EcoMart - Sustainable Marketplace',
                'slug' => 'ecomart-sustainable-marketplace',
                'description' => 'A marketplace connecting eco-conscious consumers with sustainable products.',
                'overview' => 'EcoMart is a curated marketplace for sustainable and eco-friendly products. Sellers can list their products, and buyers can discover items based on sustainability scores and certifications.',
                'challenge' => 'Building a scalable marketplace with complex product filtering (by sustainability criteria, certifications, location), integrated payments, and a review system that verifies purchases.',
                'solution' => 'Built with Laravel and Vue.js, featuring Algolia search for fast filtering, Stripe Connect for marketplace payments, and a custom sustainability scoring algorithm.',
                'results' => 'Launched with 50+ sellers and 2,000+ products. Processed $500K+ in transactions in first 6 months. Average user session time of 8 minutes.',
                'technologies' => json_encode(['Laravel 12', 'Vue 3', 'Algolia', 'Stripe Connect', 'Redis', 'MySQL', 'Tailwind CSS']),
                'live_url' => 'https://ecomart.vantage.dev',
                'github_url' => null,
                'case_study_url' => '/case-studies/ecomart',
                'start_date' => '2025-01-10',
                'end_date' => '2025-06-30',
                'status' => 'completed',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => '2025-07-15',
                'order' => 2,
                'meta_title' => 'EcoMart Case Study - Sustainable Marketplace Platform',
                'meta_description' => 'Building a sustainable e-commerce marketplace with Laravel, Vue.js, and Stripe Connect.',
                'created_at' => now()->subMonths(10),
                'updated_at' => now(),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'MediTrack - Healthcare Patient Portal',
                'slug' => 'meditrack-healthcare-portal',
                'description' => 'A secure patient portal for appointment scheduling, medical records access, and telehealth consultations.',
                'overview' => 'MediTrack provides patients with easy access to their health information, ability to schedule appointments, and conduct video consultations with healthcare providers.',
                'challenge' => 'Strict HIPAA compliance requirements, integration with multiple EHR systems, and the need for a seamless experience across desktop and mobile devices.',
                'solution' => 'Developed a HIPAA-compliant Laravel application with end-to-end encryption. Integrated with major EHR systems via HL7/FHIR standards. Built video consultation using Twilio API.',
                'results' => 'Deployed across 3 healthcare networks serving 50,000+ patients. Reduced appointment no-shows by 35% via automated reminders. Patient satisfaction score of 4.8/5.',
                'technologies' => json_encode(['Laravel 12', 'Vue 3', 'Twilio', 'MySQL', 'Redis', 'FHIR', 'Tailwind CSS']),
                'live_url' => null,
                'github_url' => null,
                'case_study_url' => '/case-studies/meditrack',
                'start_date' => '2025-04-20',
                'end_date' => '2025-11-15',
                'status' => 'completed',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2025-12-01',
                'order' => 3,
                'meta_title' => 'MediTrack Case Study - HIPAA-Compliant Healthcare Portal',
                'meta_description' => 'Building a secure, HIPAA-compliant patient portal with Laravel and Vue.js for telehealth and medical records.',
                'created_at' => now()->subMonths(6),
                'updated_at' => now(),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'ContentFlow - Headless CMS for Developers',
                'slug' => 'contentflow-headless-cms',
                'description' => 'A developer-friendly headless CMS built with Laravel and Vue.js, featuring a beautiful admin interface and powerful API.',
                'overview' => 'ContentFlow is a modern headless CMS that gives developers full control over their content while providing editors with an intuitive interface. Built specifically for Laravel and Vue.js ecosystems.',
                'challenge' => 'Creating a flexible content modeling system that doesn\'t compromise on performance, with real-time preview capabilities and version control for content.',
                'solution' => 'Built a dynamic schema system using Eloquent, implemented real-time previews with Laravel Echo, and created a plugin architecture for extensibility.',
                'results' => 'Open-sourced and adopted by 500+ development teams. Featured in Laravel News. Used by agencies to build client sites 40% faster.',
                'technologies' => json_encode(['Laravel 12', 'Vue 3', 'Pinia', 'Tailwind CSS', 'MySQL', 'Redis', 'WebSockets']),
                'live_url' => 'https://contentflow.dev',
                'github_url' => 'https://github.com/vantage/contentflow',
                'case_study_url' => '/case-studies/contentflow',
                'start_date' => '2025-07-01',
                'end_date' => '2026-01-30',
                'status' => 'completed',
                'is_featured' => true,
                'is_published' => true,
                'published_at' => '2026-02-15',
                'order' => 4,
                'meta_title' => 'ContentFlow - Building a Headless CMS with Laravel and Vue.js',
                'meta_description' => 'How we built ContentFlow, a developer-friendly headless CMS using Laravel 12 and Vue 3.',
                'created_at' => now()->subMonths(4),
                'updated_at' => now(),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'EventHub - Conference Management Platform',
                'slug' => 'eventhub-conference-platform',
                'description' => 'End-to-end conference management platform for organizers, speakers, and attendees.',
                'overview' => 'EventHub simplifies conference organization with tools for event creation, speaker management, ticket sales, schedule building, and attendee networking.',
                'challenge' => 'Handling high concurrency during ticket sales, building a real-time schedule builder, and creating networking features that encourage attendee engagement.',
                'solution' => 'Built with Laravel and Vue.js, using Laravel Horizon for queue management, Pusher for real-time features, and a custom algorithm for attendee matching.',
                'results' => 'Successfully managed 15+ tech conferences with up to 3,000 attendees. Handled 10,000+ concurrent users during ticket launches without issues. Attendee networking feature used by 65% of participants.',
                'technologies' => json_encode(['Laravel 12', 'Vue 3', 'Pusher', 'Redis', 'MySQL', 'Stripe', 'Tailwind CSS']),
                'live_url' => 'https://eventhub.dev',
                'github_url' => null,
                'case_study_url' => '/case-studies/eventhub',
                'start_date' => '2025-09-10',
                'end_date' => '2026-02-28',
                'status' => 'completed',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => '2026-03-10',
                'order' => 5,
                'meta_title' => 'EventHub Case Study - Conference Management Platform',
                'meta_description' => 'Building a scalable conference management platform with Laravel and Vue.js, handling high-traffic ticket sales.',
                'created_at' => now()->subMonths(3),
                'updated_at' => now(),
            ],
            [
                'user_id' => $admin->id,
                'title' => 'FitTrack - Personal Training App',
                'slug' => 'fittrack-personal-training',
                'description' => 'A mobile-first web app connecting personal trainers with clients for workout plans and progress tracking.',
                'overview' => 'FitTrack allows trainers to create custom workout plans, assign them to clients, and track progress. Clients can log workouts, track nutrition, and communicate with their trainers.',
                'challenge' => 'Building an intuitive workout builder, implementing complex exercise libraries, and creating engaging progress visualizations.',
                'solution' => 'Built a PWA with Laravel API and Vue.js. Implemented offline support with IndexedDB. Created drag-and-drop workout builder and rich data visualization with Chart.js.',
                'results' => 'Currently used by 200+ trainers and 3,000+ clients. Average user retention of 85% after 3 months. Trainers report 40% time savings in plan creation.',
                'technologies' => json_encode(['Laravel 12', 'Vue 3', 'Chart.js', 'IndexedDB', 'MySQL', 'Redis', 'Tailwind CSS']),
                'live_url' => 'https://fittrack.vantage.dev',
                'github_url' => null,
                'case_study_url' => '/case-studies/fittrack',
                'start_date' => '2026-01-05',
                'end_date' => null,
                'status' => 'in_progress',
                'is_featured' => false,
                'is_published' => true,
                'published_at' => null,
                'order' => 6,
                'meta_title' => 'FitTrack - Personal Training App Built with Laravel and Vue.js',
                'meta_description' => 'Building a mobile-first personal training app with Laravel and Vue.js for fitness professionals.',
                'created_at' => now()->subMonths(1),
                'updated_at' => now(),
            ],
        ];

        foreach ($projects as $projectData) {
            $project = Project::create($projectData);
            
            // Attach random tags to each project
            $projectTags = $tags->random(rand(3, 6))->pluck('id')->toArray();
            $project->tags()->attach($projectTags);
            
            // Attach to services (many-to-many)
            $serviceIds = $services->random(rand(1, 3))->pluck('id')->toArray();
            $project->services()->attach($serviceIds);
        }
    }
}