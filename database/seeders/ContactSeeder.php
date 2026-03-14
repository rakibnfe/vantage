<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\Visitor;
use Illuminate\Database\Seeder;

class ContactSeeder extends Seeder
{
    public function run(): void
    {
        $visitors = Visitor::all();

        $contacts = [
            [
                'name' => 'Michael Chen',
                'email' => 'michael.chen@techstartup.io',
                'phone' => '+1 (415) 555-0123',
                'subject' => 'Need help with e-commerce platform migration',
                'message' => "Hi,\n\nI'm the CTO at TechStartup, and we're looking to migrate our existing WooCommerce store to a custom Laravel solution. We have about 5,000 products and process around 500 orders daily.\n\nWe need:\n- Custom product management\n- Integration with our ERP\n- Multi-vendor capabilities\n- Scalable architecture\n\nCan you schedule a call to discuss? Our timeline is aggressive - hoping to launch in 3 months.",
                'budget' => '50k-100k',
                'timeline' => '3 months',
                'status' => 'new',
                'ip_address' => '192.168.1.45',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                'source_page' => '/offerings/ecommerce-development',
                'notes' => null,
                'replied_at' => null,
                'created_at' => now()->subHours(2),
                'updated_at' => now()->subHours(2),
            ],
            [
                'name' => 'Sarah Williams',
                'email' => 'sarah.williams@healthcareinnovate.com',
                'phone' => '+1 (212) 555-0789',
                'subject' => 'HIPAA-compliant patient portal',
                'message' => "We're a healthcare innovation company building a patient engagement platform. We need a HIPAA-compliant portal with:\n- Secure messaging\n- Appointment scheduling\n- Medical records access\n- Video consultation\n\nWe saw your MediTrack case study and think you'd be a great fit. Do you have experience with FHIR integrations? Looking for a development partner with healthcare expertise.",
                'budget' => '100k-250k',
                'timeline' => '6 months',
                'status' => 'replied',
                'ip_address' => '10.0.0.23',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'source_page' => '/work/meditrack-healthcare-portal',
                'notes' => 'Sent information about HIPAA compliance and scheduled discovery call for next week.',
                'replied_at' => now()->subDays(1),
                'created_at' => now()->subDays(3),
                'updated_at' => now()->subDays(1),
            ],
            [
                'name' => 'James Okafor',
                'email' => 'james.o@africatech.ng',
                'phone' => '+234 802 555 1234',
                'subject' => 'Fintech platform for African market',
                'message' => "I'm building a fintech platform targeting the Nigerian and Kenyan markets. We need:\n- Multi-currency support\n- Mobile money integration\n- KYC verification\n- Loan management\n\nWe're a startup but have seed funding. Would you be interested in building an MVP? We love your work on the wealth management platform.",
                'budget' => '25k-50k',
                'timeline' => '2 months',
                'status' => 'new',
                'ip_address' => '41.190.2.156',
                'user_agent' => 'Mozilla/5.0 (Linux; Android 14; SM-S918B) AppleWebKit/537.36',
                'source_page' => '/work/fintech-dashboard-wealth-management',
                'notes' => null,
                'replied_at' => null,
                'created_at' => now()->subHours(5),
                'updated_at' => now()->subHours(5),
            ],
            [
                'name' => 'Elena Rodriguez',
                'email' => 'elena@ecovida.es',
                'phone' => '+34 91 555 6789',
                'subject' => 'Sustainable marketplace for Spain',
                'message' => "Hola! We're launching a marketplace for sustainable products in Spain. We love EcoMart and want to build something similar for the Spanish market.\n\nKey requirements:\n- Multi-vendor\n- Localized for Spain\n- Integration with Spanish payment providers\n- Mobile app (or PWA)\n\nCan you share your availability for a video call next week?",
                'budget' => '40k-60k',
                'timeline' => '4 months',
                'status' => 'replied',
                'ip_address' => '88.16.45.123',
                'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_3_1 like Mac OS X) AppleWebKit/605.1.15',
                'source_page' => '/work/ecomart-sustainable-marketplace',
                'notes' => 'Scheduled call for Tuesday at 10 AM EST. Sent information about multi-vendor capabilities.',
                'replied_at' => now()->subHours(6),
                'created_at' => now()->subDays(1),
                'updated_at' => now()->subHours(6),
            ],
            [
                'name' => 'David Kim',
                'email' => 'david.kim@devshop.io',
                'phone' => '+82 2-555-7890',
                'subject' => 'Looking for technical partner for agency work',
                'message' => "We're a design agency in Seoul looking for a technical partner to handle development for our clients. We have 3 potential projects lined up:\n\n1. Real estate platform\n2. Corporate website with CMS\n3. Event management system\n\nInterested in discussing a white-label partnership? We handle client relationships, you handle development.",
                'budget' => null,
                'timeline' => 'ongoing',
                'status' => 'read',
                'ip_address' => '121.135.78.45',
                'user_agent' => 'Mozilla/5.0 (Macintosh; Intel Mac OS X 10_15_7) AppleWebKit/537.36',
                'source_page' => '/offerings/custom-web-development',
                'notes' => 'Interesting partnership opportunity. Discuss with team.',
                'replied_at' => null,
                'created_at' => now()->subDays(5),
                'updated_at' => now()->subDays(4),
            ],
            [
                'name' => 'Priya Patel',
                'email' => 'priya@techforgood.org',
                'phone' => '+91 22 5555 1234',
                'subject' => 'Non-profit platform for education access',
                'message' => "We're a non-profit working to improve education access in rural India. We need a platform that:\n- Works on low-bandwidth connections\n- Has offline capabilities\n- Supports multiple Indian languages\n- Tracks student progress\n\nWe have limited budget but high impact potential. Are you open to discounted rates for non-profits?",
                'budget' => '10k-20k',
                'timeline' => '3 months',
                'status' => 'closed',
                'ip_address' => '103.95.47.210',
                'user_agent' => 'Mozilla/5.0 (Linux; Android 13; Redmi Note 11) AppleWebKit/537.36',
                'source_page' => '/offerings/performance-optimization',
                'notes' => 'Offered 30% discount for non-profit. They\'re checking funding. Follow up in 2 weeks.',
                'replied_at' => now()->subDays(3),
                'created_at' => now()->subDays(10),
                'updated_at' => now()->subDays(3),
            ],
            [
                'name' => 'Thomas Weber',
                'email' => 'thomas.weber@industry40.de',
                'phone' => '+49 30 555 7890',
                'subject' => 'Industry 4.0 IoT Dashboard',
                'message' => "We're a manufacturing company building an IoT monitoring system. We need a dashboard that can:\n- Display real-time sensor data\n- Show historical trends\n- Alert on anomalies\n- Support multiple factories\n\nWe have existing APIs that stream data. Need help building the frontend and visualization layer. Are you available for a discovery call next week?",
                'budget' => '30k-45k',
                'timeline' => '3 months',
                'status' => 'new',
                'ip_address' => '87.123.45.67',
                'user_agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36',
                'source_page' => '/work',
                'notes' => null,
                'replied_at' => null,
                'created_at' => now()->subHours(1),
                'updated_at' => now()->subHours(1),
            ],
        ];

        foreach ($contacts as $index => $contactData) {
            // Assign to a random visitor if available
            if ($visitors->count() > 0 && rand(0, 2) === 0) {
                $contactData['visitor_id'] = $visitors->random()->id;
            }

            Contact::create($contactData);
        }

        // Create additional random contacts
        for ($i = 0; $i < 20; $i++) {
            $statuses = ['new', 'read', 'replied', 'closed'];
            $status = $statuses[array_rand($statuses)];
            $createdAt = now()->subDays(rand(1, 30))->subHours(rand(0, 23));
            
            $contact = [
                'name' => fake()->name(),
                'email' => fake()->email(),
                'phone' => rand(0, 1) ? fake()->phoneNumber() : null,
                'subject' => fake()->sentence(rand(4, 8)),
                'message' => fake()->paragraphs(rand(2, 5), true),
                'budget' => rand(0, 1) ? fake()->randomElement(['5k-10k', '10k-25k', '25k-50k', '50k-100k', '100k+']) : null,
                'timeline' => rand(0, 1) ? fake()->randomElement(['ASAP', '1 month', '3 months', '6 months', 'flexible']) : null,
                'status' => $status,
                'ip_address' => fake()->ipv4(),
                'user_agent' => fake()->userAgent(),
                'source_page' => fake()->randomElement(['/offerings', '/work', '/contact', '/notes', '/tools']),
                'notes' => $status === 'replied' ? fake()->sentence() : null,
                'replied_at' => $status === 'replied' ? now()->subDays(rand(1, 5)) : null,
                'created_at' => $createdAt,
                'updated_at' => $createdAt,
            ];

            Contact::create($contact);
        }
    }
}