<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Testimonial;

class TestimonialSeeder extends Seeder
{
    public function run(): void
    {
        $testimonials = [
            [
                'client_name' => 'Sarah Johnson',
                'client_role' => 'CEO',
                'client_company' => 'TechCorp Solutions',
                'content' => 'Working with this team was an absolute pleasure. They delivered a complex e-commerce platform ahead of schedule and exceeded all our expectations. The code quality is outstanding and the architecture is scalable for our future needs.',
                'rating' => 5,
                'project_name' => 'E-commerce Platform',
                'is_featured' => true,
                'order' => 1,
            ],
            [
                'client_name' => 'Michael Chen',
                'client_role' => 'CTO',
                'client_company' => 'InnovateLabs',
                'content' => 'The most professional development team I have worked with. They not only built our mobile app but also provided valuable insights that improved our product strategy. Highly recommended!',
                'rating' => 5,
                'project_name' => 'Mobile App Development',
                'is_featured' => true,
                'order' => 2,
            ],
            [
                'client_name' => 'Emily Rodriguez',
                'client_role' => 'Product Manager',
                'client_company' => 'StartupHub',
                'content' => 'Exceptional technical skills and great communication. They transformed our vague ideas into a beautiful, functional product. The team was responsive and always willing to go the extra mile.',
                'rating' => 5,
                'project_name' => 'SaaS Dashboard',
                'is_featured' => true,
                'order' => 3,
            ],
            [
                'client_name' => 'David Kim',
                'client_role' => 'Founder',
                'client_company' => 'EcoStart',
                'content' => 'They built our sustainability tracking platform from scratch. The attention to detail and user experience is remarkable. Our users love the interface!',
                'rating' => 5,
                'project_name' => 'Sustainability Platform',
                'is_featured' => false,
                'order' => 4,
            ],
            [
                'client_name' => 'Lisa Thompson',
                'client_role' => 'Marketing Director',
                'client_company' => 'GrowthGen',
                'content' => 'The analytics dashboard they built for us has transformed how we make decisions. Clean code, beautiful design, and they were a joy to work with throughout the process.',
                'rating' => 4,
                'project_name' => 'Analytics Dashboard',
                'is_featured' => false,
                'order' => 5,
            ],
            [
                'client_name' => 'James Wilson',
                'client_role' => 'Technical Lead',
                'client_company' => 'DevForge',
                'content' => 'Outstanding work on our API integration. The documentation was clear, the code was well-structured, and they handled complex requirements with ease. Will definitely work with them again.',
                'rating' => 5,
                'project_name' => 'API Integration',
                'is_featured' => true,
                'order' => 6,
            ],
        ];

        foreach ($testimonials as $testimonial) {
            Testimonial::create($testimonial);
        }
    }
}