<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Service;

Route::get('/services', function () {
    return Service::published()->ordered()->get();
});

Route::get('/services/{slug}', function ($slug) {
    return Service::published()
        ->where('slug', $slug)
        ->firstOrFail();
});
