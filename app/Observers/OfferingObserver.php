<?php

namespace App\Observers;

use App\Models\Offering;
use Illuminate\Support\Facades\Cache;

class OfferingObserver
{
    public function created(Offering $offering): void
    {
        Cache::tags(['offerings'])->flush();
    }

    public function updated(Offering $offering): void
    {
        Cache::tags(['offerings'])->flush();
    }

    public function deleted(Offering $offering): void
    {
        Cache::tags(['offerings'])->flush();
    }

    public function restored(Offering $offering): void
    {
        Cache::tags(['offerings'])->flush();
    }

    public function forceDeleted(Offering $offering): void
    {
        Cache::tags(['offerings'])->flush();
    }
}