<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController as AdminServiceController;
use App\Http\Controllers\Admin\ProjectController as AdminProjectController;
use App\Http\Controllers\Admin\ArticleController as AdminArticleController;
use App\Http\Controllers\Admin\BookingController as AdminBookingController;
use App\Http\Controllers\Admin\ContactController as AdminContactController;
use App\Http\Controllers\Admin\TestimonialController as AdminTestimonialController;
use App\Http\Controllers\Admin\ToolController as AdminToolController;
use App\Http\Controllers\Admin\InsightController as AdminInsightController;
use App\Http\Controllers\Admin\MediaController as AdminMediaController;
use App\Http\Controllers\Admin\UserController as AdminUserController;
use App\Http\Controllers\Admin\SettingController as AdminSettingController;

// Dashboard Routes (requires authentication and email verification)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::prefix('dashboard')->name('dashboard.')->group(function () {
        
        // Dashboard Home
        Route::get('/', [DashboardController::class, 'index'])->name('index');
        Route::get('stats', [DashboardController::class, 'stats'])->name('stats');
        Route::get('recent-activities', [DashboardController::class, 'recentActivities'])->name('activities');
        
        // Services Management
        Route::resource('services', AdminServiceController::class);
        Route::post('services/reorder', [AdminServiceController::class, 'reorder'])->name('services.reorder');
        Route::post('services/{service}/toggle-status', [AdminServiceController::class, 'toggleStatus'])->name('services.toggle');
        Route::post('services/{service}/clone', [AdminServiceController::class, 'clone'])->name('services.clone');
        
        // Projects Management
        Route::resource('projects', AdminProjectController::class);
        Route::post('projects/reorder', [AdminProjectController::class, 'reorder'])->name('projects.reorder');
        Route::post('projects/{project}/toggle-featured', [AdminProjectController::class, 'toggleFeatured'])->name('projects.toggle-featured');
        Route::post('projects/{project}/toggle-published', [AdminProjectController::class, 'togglePublished'])->name('projects.toggle-published');
        
        // Articles Management
        Route::resource('articles', AdminArticleController::class);
        Route::post('articles/{article}/toggle-published', [AdminArticleController::class, 'togglePublished'])->name('articles.toggle');
        Route::get('articles/categories', [AdminArticleController::class, 'categories'])->name('articles.categories');
        Route::post('articles/categories', [AdminArticleController::class, 'storeCategory'])->name('articles.categories.store');
        Route::delete('articles/categories/{category}', [AdminArticleController::class, 'destroyCategory'])->name('articles.categories.destroy');
        
        // Bookings/Schedules Management
        Route::resource('bookings', AdminBookingController::class);
        Route::get('calendar', [AdminBookingController::class, 'calendar'])->name('calendar');
        Route::post('bookings/{booking}/approve', [AdminBookingController::class, 'approve'])->name('bookings.approve');
        Route::post('bookings/{booking}/decline', [AdminBookingController::class, 'decline'])->name('bookings.decline');
        Route::post('bookings/{booking}/complete', [AdminBookingController::class, 'complete'])->name('bookings.complete');
        Route::get('availability', [AdminBookingController::class, 'availability'])->name('availability');
        Route::post('availability/store', [AdminBookingController::class, 'storeAvailability'])->name('availability.store');
        
        // Contacts/Inquiries
        Route::resource('contacts', AdminContactController::class)->only(['index', 'show', 'destroy']);
        Route::post('contacts/{contact}/reply', [AdminContactController::class, 'reply'])->name('contacts.reply');
        Route::post('contacts/{contact}/mark-as', [AdminContactController::class, 'markAs'])->name('contacts.mark');
        Route::post('contacts/bulk-action', [AdminContactController::class, 'bulkAction'])->name('contacts.bulk');
        
        // Testimonials
        Route::resource('testimonials', AdminTestimonialController::class);
        Route::post('testimonials/reorder', [AdminTestimonialController::class, 'reorder'])->name('testimonials.reorder');
        Route::post('testimonials/{testimonial}/toggle-featured', [AdminTestimonialController::class, 'toggleFeatured'])->name('testimonials.toggle');
        
        // Tools Management
        Route::resource('tools', AdminToolController::class)->only(['index', 'edit', 'update']);
        Route::post('tools/{tool}/toggle', [AdminToolController::class, 'toggle'])->name('tools.toggle');
        Route::get('tools/stats', [AdminToolController::class, 'stats'])->name('tools.stats');
        
        // Insights/Analytics
        Route::prefix('insights')->name('insights.')->group(function () {
            Route::get('/', [AdminInsightController::class, 'index'])->name('index');
            Route::get('visitors', [AdminInsightController::class, 'visitors'])->name('visitors');
            Route::get('page-views', [AdminInsightController::class, 'pageViews'])->name('page-views');
            Route::get('popular-content', [AdminInsightController::class, 'popularContent'])->name('popular');
            Route::get('export', [AdminInsightController::class, 'export'])->name('export');
        });
        
        // Media Library
        Route::prefix('media')->name('media.')->group(function () {
            Route::get('/', [AdminMediaController::class, 'index'])->name('index');
            Route::post('upload', [AdminMediaController::class, 'upload'])->name('upload');
            Route::delete('{media}', [AdminMediaController::class, 'destroy'])->name('destroy');
            Route::post('folder/create', [AdminMediaController::class, 'createFolder'])->name('folder.create');
            Route::delete('folder/{folder}', [AdminMediaController::class, 'deleteFolder'])->name('folder.delete');
            Route::post('bulk-delete', [AdminMediaController::class, 'bulkDelete'])->name('bulk-delete');
        });
        
        // Users Management
        Route::resource('users', AdminUserController::class);
        Route::post('users/{user}/toggle-status', [AdminUserController::class, 'toggleStatus'])->name('users.toggle');
        Route::post('users/{user}/assign-role', [AdminUserController::class, 'assignRole'])->name('users.role');
        
        // Settings
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [AdminSettingController::class, 'index'])->name('index');
            Route::post('general', [AdminSettingController::class, 'updateGeneral'])->name('general');
            Route::post('seo', [AdminSettingController::class, 'updateSeo'])->name('seo');
            Route::post('email', [AdminSettingController::class, 'updateEmail'])->name('email');
            Route::post('social', [AdminSettingController::class, 'updateSocial'])->name('social');
            Route::post('backup', [AdminSettingController::class, 'backup'])->name('backup');
            Route::get('logs', [AdminSettingController::class, 'logs'])->name('logs');
        });
    });
});