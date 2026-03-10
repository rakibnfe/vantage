<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CategoryController;

// Test route
Route::get('/ping', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is working',
        'timestamp' => now()->toIso8601String()
    ]);
});

// API v1 routes
Route::prefix('v1')->group(function () {
    
    // Services API
    Route::prefix('services')->group(function () {
        Route::get('/', [ServiceController::class, 'index']);
        Route::get('/featured', [ServiceController::class, 'featured']);
        Route::get('/{service:slug}', [ServiceController::class, 'show']);
        Route::get('/{service:slug}/projects', [ServiceController::class, 'projects']);
        Route::get('/{service:slug}/technologies', [ServiceController::class, 'technologies']);
        Route::get('/{service:slug}/faqs', [ServiceController::class, 'faqs']);
        Route::get('/{service:slug}/process-steps', [ServiceController::class, 'processSteps']);
        Route::get('/{service:slug}/pricing', [ServiceController::class, 'pricing']);
    });


    // Projects API
    Route::prefix('projects')->group(function () {
        Route::get('/', [ProjectController::class, 'index']);
        Route::get('/featured', [ProjectController::class, 'featured']);
        Route::get('/{project:slug}', [ProjectController::class, 'show']);
        Route::get('/status/{status}', [ProjectController::class, 'byStatus']);
        Route::get('/tag/{tag:slug}', [ProjectController::class, 'byTag']);
        Route::get('/{project:slug}/related', [ProjectController::class, 'related']);
        Route::get('/{project:slug}/technologies', [ProjectController::class, 'technologies']);
    });

    // Tags API
    Route::get('/tags', [TagController::class, 'index']);
    Route::get('/tags/{tag:slug}', [TagController::class, 'show']);
    
    // Categories API
    Route::get('/categories', [CategoryController::class, 'index']);
});