<?php

namespace App\Providers;

use App\Models\Offering;
use App\Repositories\OfferingRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(OfferingRepository::class, function ($app) {
            return new OfferingRepository($app->make(Offering::class));
        });
    }

    public function boot(): void
    {
        //
    }
}