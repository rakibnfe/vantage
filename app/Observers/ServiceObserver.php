<?php

namespace App\Observers;

use App\Models\Service;
use Illuminate\Support\Facades\Cache;

class ServiceObserver
{
    public function created(Service $service): void
    {
        Cache::tags(['services'])->flush();
    }

    public function updated(Service $service): void
    {
        Cache::tags(['services'])->flush();
    }

    public function deleted(Service $service): void
    {
        Cache::tags(['services'])->flush();
    }

    public function restored(Service $service): void
    {
        Cache::tags(['services'])->flush();
    }

    public function forceDeleted(Service $service): void
    {
        Cache::tags(['services'])->flush();
    }
}