<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ServiceController;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\ArticleController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\TestimonialController;
use App\Http\Controllers\Api\FaqController;
use App\Http\Controllers\Api\ProcessController;
use App\Http\Controllers\Api\PricingController;
use App\Http\Controllers\Api\ScheduleController;
use App\Http\Controllers\Api\ContactController;

Route::get('/ping', function () {
    return response()->json([
        'status' => 'ok',
        'message' => 'API is working',
        'timestamp' => now()->toIso8601String()
    ]);
});

Route::prefix('v1')->group(function () {
    // Services API
    Route::apiResource('services', ServiceController::class)->only(['index', 'show']);
    Route::prefix('services')->group(function () {
        Route::get('{service}/projects', [ServiceController::class, 'projects']);
        Route::get('{service}/technologies', [ServiceController::class, 'technologies']);
        Route::get('{service}/faqs', [ServiceController::class, 'faqs']);
        Route::get('{service}/process-steps', [ServiceController::class, 'processSteps']);
        Route::get('{service}/pricing', [ServiceController::class, 'pricing']);
    });

    // Projects API
    Route::apiResource('projects', ProjectController::class)->only(['index', 'show']);
    Route::prefix('projects')->group(function () {
        Route::get('{project}/related', [ProjectController::class, 'related']);
        Route::get('{project}/technologies', [ProjectController::class, 'technologies']);
    });

    // Articles API
    Route::apiResource('articles', ArticleController::class)->only(['index', 'show']);
    Route::prefix('articles')->group(function () {
        Route::get('{article}/related', [ArticleController::class, 'related']);
    });

    // Categories & Tags
    Route::apiResource('categories', CategoryController::class)->only(['index', 'show']);
    Route::apiResource('tags', TagController::class)->only(['index', 'show']);

    // Testimonials
    Route::apiResource('testimonials', TestimonialController::class)->only(['index', 'show']);
    Route::get('testimonials/featured', [TestimonialController::class, 'featured']);

    // ========== FAQ ROUTES ==========
    Route::prefix('faqs')->name('faqs.')->group(function () {
        Route::get('/', [FaqController::class, 'index'])->name('index');
        Route::get('/featured', [FaqController::class, 'featured'])->name('featured');
        Route::get('/service/{serviceSlug}', [FaqController::class, 'byService'])->name('by-service');
        Route::get('/{id}', [FaqController::class, 'show'])->name('show');
    });

    // ========== PROCESS ROUTES ==========
    Route::prefix('process-steps')->name('process.')->group(function () {
        Route::get('/', [ProcessController::class, 'index'])->name('index');
        Route::get('/grouped', [ProcessController::class, 'grouped'])->name('grouped');
        Route::get('/service/{serviceSlug}', [ProcessController::class, 'byService'])->name('by-service');
        Route::get('/{id}', [ProcessController::class, 'show'])->name('show');
    });

    // ========== PRICING ROUTES ==========
    Route::prefix('pricing')->name('pricing.')->group(function () {
        Route::get('/', [PricingController::class, 'index'])->name('index');
        Route::get('/comparison', [PricingController::class, 'comparison'])->name('comparison');
        Route::get('/summary', [PricingController::class, 'summary'])->name('summary');
        Route::get('/service/{serviceSlug}', [PricingController::class, 'byService'])->name('by-service');
        Route::get('/{id}', [PricingController::class, 'show'])->name('show');
    });

    

    Route::apiResource('schedules', ScheduleController::class);
    Route::post('schedules/check-availability', [ScheduleController::class, 'checkAvailability']);
    Route::get('schedules/available-slots', [ScheduleController::class, 'getAvailableSlots']);

  Route::post('contacts', [ContactController::class, 'store']);
});