<?php

namespace App\Providers;

use App\Models\Offering;
use App\Models\Project;
use App\Models\Article;
use App\Models\Schedule;
use App\Models\Contact;
use App\Models\Testimonial;
use App\Models\Tool;
use App\Models\User;
use App\Policies\OfferingPolicy;
use App\Policies\ProjectPolicy;
use App\Policies\ArticlePolicy;
use App\Policies\BookingPolicy;
use App\Policies\ContactPolicy;
use App\Policies\TestimonialPolicy;
use App\Policies\ToolPolicy;
use App\Policies\UserPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The model to policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        Offering::class => OfferingPolicy::class,
        Project::class => ProjectPolicy::class,
        Article::class => ArticlePolicy::class,
        Schedule::class => BookingPolicy::class,
        Contact::class => ContactPolicy::class,
        Testimonial::class => TestimonialPolicy::class,
        Tool::class => ToolPolicy::class,
        User::class => UserPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     */
    public function boot(): void
    {
        $this->registerPolicies();
        
        // Optional: Define gates if needed
        Gate::before(function ($user, $ability) {
            if ($user->role === 'admin') {
                return true;
            }
        });
    }
}