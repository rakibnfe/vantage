<?php

namespace App\Providers;

use App\Models\Service;
use App\Repositories\ServiceRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        $this->app->bind(ServiceRepository::class, function ($app) {
            return new ServiceRepository($app->make(Service::class));
        });
    }

    public function boot(): void
    {
        //
    }
}