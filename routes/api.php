<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\OfferingController;
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
    // Offerings API
    Route::apiResource('offerings', OfferingController::class)->only(['index', 'show']);
    Route::prefix('offerings')->group(function () {
        Route::get('{offering}/projects', [OfferingController::class, 'projects']);
        Route::get('{offering}/technologies', [OfferingController::class, 'technologies']);
        Route::get('{offering}/faqs', [OfferingController::class, 'faqs']);
        Route::get('{offering}/process-steps', [OfferingController::class, 'processSteps']);
        Route::get('{offering}/pricing', [OfferingController::class, 'pricing']);
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
        Route::get('/offering/{offeringSlug}', [FaqController::class, 'byOffering'])->name('by-offering');
        Route::get('/{id}', [FaqController::class, 'show'])->name('show');
    });

    // ========== PROCESS ROUTES ==========
    Route::prefix('process-steps')->name('process.')->group(function () {
        Route::get('/', [ProcessController::class, 'index'])->name('index');
        Route::get('/grouped', [ProcessController::class, 'grouped'])->name('grouped');
        Route::get('/offering/{offeringSlug}', [ProcessController::class, 'byOffering'])->name('by-offering');
        Route::get('/{id}', [ProcessController::class, 'show'])->name('show');
    });

    // ========== PRICING ROUTES ==========
    Route::prefix('pricing')->name('pricing.')->group(function () {
        Route::get('/', [PricingController::class, 'index'])->name('index');
        Route::get('/comparison', [PricingController::class, 'comparison'])->name('comparison');
        Route::get('/summary', [PricingController::class, 'summary'])->name('summary');
        Route::get('/offering/{offeringSlug}', [PricingController::class, 'byOffering'])->name('by-offering');
        Route::get('/{id}', [PricingController::class, 'show'])->name('show');
    });

    

    Route::apiResource('schedules', ScheduleController::class);
    Route::post('schedules/check-availability', [ScheduleController::class, 'checkAvailability']);
    Route::get('schedules/available-slots', [ScheduleController::class, 'getAvailableSlots']);

  Route::post('contacts', [ContactController::class, 'store']);
});