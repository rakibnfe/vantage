<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceFeature;
use App\Models\ServiceProcessStep;
use App\Models\ServiceFAQ;
use App\Models\ServiceTechnology;
use App\Models\ServicePricingModel;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    public function run(): void
    {
        // Get tags for relationships
        $laravelTag = Tag::where('slug', 'laravel-12')->first();
        $vueTag = Tag::where('slug', 'vue-3')->first();
        $apiTag = Tag::where('slug', 'api-development')->first();
        $securityTag = Tag::where('slug', 'security')->first();

        // 1. Web Development Service
        $webDev = Service::create([
            'title' => 'Custom Web Development',
            'slug' => 'custom-web-development',
            'tagline' => 'Build powerful, scalable web applications that drive business growth',
            'icon' => 'code-bracket',
            'featured_image' => null,
            'overview' => 'We craft bespoke web solutions tailored to your unique business needs. From dynamic SPAs to complex enterprise platforms, our expertise spans the entire development lifecycle.',
            'description' => 'Full-cycle web development services combining Laravel\'s robust backend capabilities with Vue.js\'s reactive frontend to create seamless, high-performance applications. We follow industry best practices, ensuring clean code, security, and scalability.',
            'success_stories' => 'Helped a fintech startup scale to 100k+ users in 6 months with our custom banking platform. Delivered 40% faster load times for an e-commerce client through optimization.',
            'delivery_timeframe' => '4-12 weeks',
            'team_size' => '2-4 developers',
            'consultation_url' => '/schedule',
            'meta_title' => 'Custom Web Development Services | Laravel & Vue.js Experts',
            'meta_description' => 'Professional web development services using Laravel 12 and Vue 3. We build scalable, secure, and high-performance web applications tailored to your business needs.',
            'is_published' => true,
            'is_featured' => true,
            'order' => 1,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Attach tags
        $webDev->tags()->attach([$laravelTag->id, $vueTag->id, $apiTag->id]);

        // Features
        $features = [
            [
                'service_id' => $webDev->id,
                'title' => 'Custom API Development',
                'description' => 'RESTful and GraphQL APIs designed for scalability, with automatic documentation, rate limiting, and versioning.',
                'icon' => 'api',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Responsive Frontend',
                'description' => 'Beautiful, mobile-first interfaces built with Vue 3 and Tailwind CSS, ensuring perfect experiences across all devices.',
                'icon' => 'device-mobile',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Database Architecture',
                'description' => 'Optimized database design with Eloquent ORM, query optimization, and migration strategies for data integrity.',
                'icon' => 'database',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Security & Authentication',
                'description' => 'Enterprise-grade security with Laravel Sanctum, role-based access control, and GDPR compliance.',
                'icon' => 'lock-closed',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Performance Optimization',
                'description' => 'Lazy loading, caching strategies, database indexing, and CDN integration for lightning-fast load times.',
                'icon' => 'bolt',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'SEO & Analytics',
                'description' => 'Built-in SEO best practices, meta management, and analytics integration to track user behavior.',
                'icon' => 'chart-bar',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($features as $feature) {
            ServiceFeature::create($feature);
        }

        // Process Steps
        $processSteps = [
            [
                'service_id' => $webDev->id,
                'title' => 'Discovery & Planning',
                'description' => 'We dive deep into your business goals, user needs, and technical requirements. Create user stories, wireframes, and technical specifications.',
                'icon' => 'clipboard-document',
                'duration' => '1-2 weeks',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Design & Prototyping',
                'description' => 'Design intuitive interfaces and user experiences. Create interactive prototypes for early feedback and validation.',
                'icon' => 'paint-brush',
                'duration' => '1-3 weeks',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Development',
                'description' => 'Agile development with regular sprints. Daily updates, continuous integration, and thorough testing at every stage.',
                'icon' => 'code-bracket',
                'duration' => '4-8 weeks',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Testing & QA',
                'description' => 'Comprehensive testing including unit tests, integration tests, and user acceptance testing to ensure quality.',
                'icon' => 'beaker',
                'duration' => '1-2 weeks',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Deployment & Launch',
                'description' => 'Smooth deployment to production servers, DNS configuration, SSL setup, and performance monitoring.',
                'icon' => 'rocket-launch',
                'duration' => '1 week',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'title' => 'Ongoing Support',
                'description' => 'Post-launch monitoring, bug fixes, performance optimization, and feature enhancements as needed.',
                'icon' => 'wrench-screwdriver',
                'duration' => 'Ongoing',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($processSteps as $step) {
            ServiceProcessStep::create($step);
        }

        // FAQs
        $faqs = [
            [
                'service_id' => $webDev->id,
                'question' => 'How long does it take to build a custom web application?',
                'answer' => 'Timelines vary based on complexity. A simple brochure site might take 3-4 weeks, while complex web applications can take 3-6 months. We\'ll provide a detailed timeline during our discovery phase.',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'question' => 'Do you provide ongoing maintenance after launch?',
                'answer' => 'Yes! We offer various support and maintenance packages to keep your application secure, up-to-date, and running smoothly. This includes security patches, performance monitoring, and priority support.',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'question' => 'What technologies do you specialize in?',
                'answer' => 'Our core stack is Laravel PHP for backend and Vue.js for frontend. We also work with MySQL/PostgreSQL, Tailwind CSS, Alpine.js, and various third-party integrations. We\'re always learning and adopting new technologies as needed.',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'question' => 'How do you handle project communication?',
                'answer' => 'We use tools like Slack for daily communication, Trello/ClickUp for task tracking, and regular video calls for progress updates. You\'ll have full visibility into the development process.',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'question' => 'Can you work with our existing team?',
                'answer' => 'Absolutely! We can integrate with your in-house team, provide training, or work as an extension of your development department. We\'re flexible to your needs.',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'question' => 'What about mobile apps? Do you build those?',
                'answer' => 'While we focus on web applications, we can build progressive web apps (PWAs) that work like native mobile apps. For complex mobile needs, we can recommend trusted partners.',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($faqs as $faq) {
            ServiceFAQ::create($faq);
        }

        // Technologies
        $technologies = [
            // Backend
            ['service_id' => $webDev->id, 'name' => 'Laravel 12', 'category' => 'Backend', 'icon' => 'laravel', 'url' => 'https://laravel.com', 'order' => 1, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'PHP 8.3', 'category' => 'Backend', 'icon' => 'php', 'url' => 'https://php.net', 'order' => 2, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'MySQL 8', 'category' => 'Database', 'icon' => 'mysql', 'url' => 'https://mysql.com', 'order' => 3, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'PostgreSQL', 'category' => 'Database', 'icon' => 'postgresql', 'url' => 'https://postgresql.org', 'order' => 4, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'Redis', 'category' => 'Caching', 'icon' => 'redis', 'url' => 'https://redis.io', 'order' => 5, 'created_at' => now(), 'updated_at' => now()],
            
            // Frontend
            ['service_id' => $webDev->id, 'name' => 'Vue 3', 'category' => 'Frontend', 'icon' => 'vue', 'url' => 'https://vuejs.org', 'order' => 6, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'Pinia', 'category' => 'State Management', 'icon' => 'pinia', 'url' => 'https://pinia.vuejs.org', 'order' => 7, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'Tailwind CSS', 'category' => 'Styling', 'icon' => 'tailwind', 'url' => 'https://tailwindcss.com', 'order' => 8, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'Alpine.js', 'category' => 'Frontend', 'icon' => 'alpine', 'url' => 'https://alpinejs.dev', 'order' => 9, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'Inertia.js', 'category' => 'Full-stack', 'icon' => 'inertia', 'url' => 'https://inertiajs.com', 'order' => 10, 'created_at' => now(), 'updated_at' => now()],
            
            // DevOps
            ['service_id' => $webDev->id, 'name' => 'Docker', 'category' => 'DevOps', 'icon' => 'docker', 'url' => 'https://docker.com', 'order' => 11, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'GitHub Actions', 'category' => 'CI/CD', 'icon' => 'github', 'url' => 'https://github.com/features/actions', 'order' => 12, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'AWS', 'category' => 'Cloud', 'icon' => 'aws', 'url' => 'https://aws.amazon.com', 'order' => 13, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'Laravel Forge', 'category' => 'Server Management', 'icon' => 'forge', 'url' => 'https://forge.laravel.com', 'order' => 14, 'created_at' => now(), 'updated_at' => now()],
            ['service_id' => $webDev->id, 'name' => 'Laravel Vapor', 'category' => 'Serverless', 'icon' => 'vapor', 'url' => 'https://vapor.laravel.com', 'order' => 15, 'created_at' => now(), 'updated_at' => now()],
        ];
        foreach ($technologies as $tech) {
            ServiceTechnology::create($tech);
        }

        // Pricing Models
        $pricingModels = [
            [
                'service_id' => $webDev->id,
                'name' => 'Fixed Price',
                'description' => 'Perfect for well-defined projects with clear requirements. We provide a fixed quote based on detailed specifications.',
                'starting_price' => 15000.00,
                'notes' => 'Best for small to medium projects with stable requirements',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'name' => 'Time & Materials',
                'description' => 'Ideal for evolving projects. You pay for actual hours worked with transparent tracking and flexible scope.',
                'starting_price' => 85.00,
                'notes' => 'Hourly rate: $85-150 depending on expertise needed',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'name' => 'Retainer',
                'description' => 'Ongoing development and maintenance with dedicated team time. Includes priority support and discounted rates.',
                'starting_price' => 5000.00,
                'notes' => 'Monthly retainer starting at $5,000/month',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $webDev->id,
                'name' => 'MVP Package',
                'description' => 'Get your product to market quickly with our focused MVP development package.',
                'starting_price' => 25000.00,
                'notes' => 'Includes core features, basic design, and deployment',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($pricingModels as $model) {
            ServicePricingModel::create($model);
        }

        // 2. E-commerce Development Service
        $ecommerce = Service::create([
            'title' => 'E-commerce Development',
            'slug' => 'ecommerce-development',
            'tagline' => 'Build online stores that convert visitors into loyal customers',
            'icon' => 'shopping-cart',
            'featured_image' => null,
            'overview' => 'Create powerful online shopping experiences with custom e-commerce solutions. From inventory management to payment processing, we build stores that scale with your business.',
            'description' => 'Modern e-commerce platforms built with Laravel and Vue.js, offering seamless shopping experiences, secure payments, and powerful admin dashboards. We integrate with major payment gateways, shipping providers, and inventory systems.',
            'success_stories' => 'Built a multi-vendor marketplace handling $2M+ in annual transactions. Increased conversion rate by 35% for a boutique fashion brand.',
            'delivery_timeframe' => '6-16 weeks',
            'team_size' => '2-3 developers + UX designer',
            'consultation_url' => '/schedule',
            'meta_title' => 'Custom E-commerce Development | Laravel E-commerce Solutions',
            'meta_description' => 'Professional e-commerce development services. Build custom online stores with Laravel and Vue.js. Payment integration, inventory management, and more.',
            'is_published' => true,
            'is_featured' => true,
            'order' => 2,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Attach security tag
        $ecommerce->tags()->attach([$securityTag->id]);

        // Features for E-commerce
        $ecommerceFeatures = [
            [
                'service_id' => $ecommerce->id,
                'title' => 'Product Management',
                'description' => 'Comprehensive product catalog with variants, attributes, inventory tracking, and bulk import/export capabilities.',
                'icon' => 'cube',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Secure Checkout',
                'description' => 'PCI-compliant checkout process with multiple payment gateways, saved payment methods, and one-click purchasing.',
                'icon' => 'lock-closed',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Order Management',
                'description' => 'Powerful admin dashboard for order processing, fulfillment tracking, and customer communication.',
                'icon' => 'clipboard-document-list',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Marketing Tools',
                'description' => 'Built-in SEO, discount codes, abandoned cart recovery, and email marketing integration.',
                'icon' => 'megaphone',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Analytics Dashboard',
                'description' => 'Real-time sales analytics, customer behavior tracking, and conversion funnel optimization.',
                'icon' => 'chart-bar',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Mobile-Optimized',
                'description' => 'Fully responsive design with mobile-first approach and progressive web app capabilities.',
                'icon' => 'device-phone-mobile',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($ecommerceFeatures as $feature) {
            ServiceFeature::create($feature);
        }

        // Process Steps for E-commerce
        $ecommerceProcess = [
            [
                'service_id' => $ecommerce->id,
                'title' => 'Requirements & Planning',
                'description' => 'Define product catalog structure, payment flows, and business rules. Map out user journey and conversion goals.',
                'icon' => 'clipboard-document',
                'duration' => '1-2 weeks',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'UX/UI Design',
                'description' => 'Design intuitive shopping experiences, product pages, and checkout flows optimized for conversion.',
                'icon' => 'paint-brush',
                'duration' => '2-3 weeks',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Development',
                'description' => 'Build catalog, shopping cart, payment integration, and admin dashboard using agile methodology.',
                'icon' => 'code-bracket',
                'duration' => '6-10 weeks',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Testing & Security Audit',
                'description' => 'Comprehensive testing including payment flows, security vulnerability assessment, and load testing.',
                'icon' => 'shield-check',
                'duration' => '2 weeks',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Launch & Migration',
                'description' => 'Smooth product data migration, DNS configuration, and soft launch with monitoring.',
                'icon' => 'rocket-launch',
                'duration' => '1 week',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'title' => 'Post-Launch Optimization',
                'description' => 'Monitor performance, analyze user behavior, and continuously optimize for better conversions.',
                'icon' => 'arrow-trending-up',
                'duration' => 'Ongoing',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($ecommerceProcess as $step) {
            ServiceProcessStep::create($step);
        }

        // FAQs for E-commerce
        $ecommerceFaqs = [
            [
                'service_id' => $ecommerce->id,
                'question' => 'Which payment gateways do you support?',
                'answer' => 'We integrate with all major payment providers including Stripe, PayPal, Square, Braintree, and Authorize.net. We can also work with local payment processors as needed.',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'question' => 'Can you migrate my existing store to a new platform?',
                'answer' => 'Absolutely! We have extensive experience migrating from platforms like WooCommerce, Shopify, Magento, and custom solutions. We ensure all product data, customer information, and order history is transferred securely.',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'question' => 'How do you handle inventory management?',
                'answer' => 'We build robust inventory systems with real-time stock tracking, low stock alerts, and integration with ERP systems. We can also sync with physical POS systems for omnichannel retail.',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'question' => 'Is your e-commerce solution SEO-friendly?',
                'answer' => 'Yes! Our platforms are built with SEO best practices from the ground up including clean URLs, meta tags, schema markup, sitemaps, and fast loading times crucial for rankings.',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'question' => 'Do you provide training for managing the store?',
                'answer' => 'Definitely! We provide comprehensive training for your team on product management, order processing, and using the analytics dashboard. We also create detailed documentation.',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $ecommerce->id,
                'question' => 'Can you integrate with third-party services like shipping or accounting?',
                'answer' => 'Yes, we integrate with major shipping providers (UPS, FedEx, USPS), accounting software (QuickBooks, Xero), email marketing tools (Mailchimp, Klaviyo), and ERP systems.',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($ecommerceFaqs as $faq) {
            ServiceFAQ::create($faq);
        }

        // 3. API Development & Integration Service
        $apiDev = Service::create([
            'title' => 'API Development & Integration',
            'slug' => 'api-development',
            'tagline' => 'Connect your systems and build powerful integrations with custom APIs',
            'icon' => 'cloud',
            'featured_image' => null,
            'overview' => 'Design and build robust APIs that power your applications and connect your business systems. From RESTful services to GraphQL, we create scalable, well-documented APIs.',
            'description' => 'Professional API development services including design, documentation, testing, and integration. We build APIs that are secure, performant, and easy to use for developers.',
            'success_stories' => 'Built a unified API layer connecting 5 legacy systems for a logistics company, reducing integration time by 70%.',
            'delivery_timeframe' => '3-8 weeks',
            'team_size' => '2 backend developers',
            'consultation_url' => '/schedule',
            'meta_title' => 'API Development Services | REST & GraphQL API Experts',
            'meta_description' => 'Professional API development and integration services. Build secure, scalable APIs with Laravel. Connect your systems and third-party services.',
            'is_published' => true,
            'is_featured' => false,
            'order' => 3,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // Features for API Dev
        $apiFeatures = [
            [
                'service_id' => $apiDev->id,
                'title' => 'RESTful API Design',
                'description' => 'Well-structured REST APIs following best practices with proper resource naming, HTTP methods, and status codes.',
                'icon' => 'link',
                'order' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $apiDev->id,
                'title' => 'GraphQL APIs',
                'description' => 'Flexible GraphQL APIs that let clients request exactly the data they need, reducing over-fetching.',
                'icon' => 'graph',
                'order' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $apiDev->id,
                'title' => 'Authentication & Security',
                'description' => 'Secure API authentication with Laravel Sanctum, OAuth2, JWT, or API keys. Rate limiting and request validation.',
                'icon' => 'lock-closed',
                'order' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $apiDev->id,
                'title' => 'API Documentation',
                'description' => 'Interactive API documentation with Swagger/OpenAPI, making it easy for developers to understand and use your APIs.',
                'icon' => 'document-text',
                'order' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $apiDev->id,
                'title' => 'Third-party Integrations',
                'description' => 'Seamless integration with external services like Stripe, Salesforce, Slack, and custom enterprise systems.',
                'icon' => 'puzzle-piece',
                'order' => 5,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'service_id' => $apiDev->id,
                'title' => 'Monitoring & Analytics',
                'description' => 'Track API usage, performance metrics, and error rates with detailed logging and alerting.',
                'icon' => 'chart-bar',
                'order' => 6,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];
        foreach ($apiFeatures as $feature) {
            ServiceFeature::create($feature);
        }

        // 4. Performance Optimization Service
        $performance = Service::create([
            'title' => 'Performance Optimization',
            'slug' => 'performance-optimization',
            'tagline' => 'Make your applications lightning fast and highly scalable',
            'icon' => 'bolt',
            'featured_image' => null,
            'overview' => 'Identify and eliminate performance bottlenecks in your web applications. We optimize database queries, implement caching strategies, and fine-tune server configurations.',
            'description' => 'Comprehensive performance audit and optimization services. We analyze your application\'s performance, identify issues, and implement solutions to make it faster and more efficient.',
            'success_stories' => 'Reduced API response time from 800ms to 120ms for a SaaS platform serving 50,000+ daily users.',
            'delivery_timeframe' => '2-6 weeks',
            'team_size' => '1-2 performance specialists',
            'consultation_url' => '/schedule',
            'meta_title' => 'Web Performance Optimization Services | Laravel Performance Experts',
            'meta_description' => 'Professional performance optimization for Laravel and Vue.js applications. Database optimization, caching, and server tuning.',
            'is_published' => true,
            'is_featured' => false,
            'order' => 4,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        // 5. Technical Consulting & Code Review
        $consulting = Service::create([
            'title' => 'Technical Consulting & Code Review',
            'slug' => 'technical-consulting',
            'tagline' => 'Expert guidance for your development team and projects',
            'icon' => 'chat-bubble-bottom-center-text',
            'featured_image' => null,
            'overview' => 'Get expert advice on architecture decisions, technology choices, and best practices. We review your codebase and provide actionable recommendations.',
            'description' => 'Technical consulting services including code reviews, architecture planning, technology selection, and team mentoring. Help your team build better software.',
            'success_stories' => 'Mentored a startup team of 5 developers, helping them reduce technical debt by 60% and improve code quality.',
            'delivery_timeframe' => 'Flexible',
            'team_size' => '1 senior architect',
            'consultation_url' => '/schedule',
            'meta_title' => 'Technical Consulting & Code Review | Laravel Architecture Experts',
            'meta_description' => 'Expert technical consulting for Laravel applications. Code reviews, architecture planning, and team mentoring.',
            'is_published' => true,
            'is_featured' => false,
            'order' => 5,
            'published_at' => now(),
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}