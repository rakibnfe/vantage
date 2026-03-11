<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\ProjectController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\BookingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\TestimonialController;
use App\Http\Controllers\Admin\ToolController;
use App\Http\Controllers\Admin\InsightController;
use App\Http\Controllers\Admin\MediaController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\SettingController;

// Admin Routes (requires authentication)
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    
    // Dashboard
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('dashboard/stats', [DashboardController::class, 'stats'])->name('dashboard.stats');
    Route::get('dashboard/recent-activities', [DashboardController::class, 'recentActivities'])->name('dashboard.activities');
    
    // Services Management
    Route::resource('services', ServiceController::class);
    Route::post('services/reorder', [ServiceController::class, 'reorder'])->name('services.reorder');
    Route::post('services/{service}/toggle-status', [ServiceController::class, 'toggleStatus'])->name('services.toggle');
    Route::post('services/{service}/clone', [ServiceController::class, 'clone'])->name('services.clone');
    
    // Projects Management
    Route::resource('projects', ProjectController::class);
    Route::post('projects/reorder', [ProjectController::class, 'reorder'])->name('projects.reorder');
    Route::post('projects/{project}/toggle-featured', [ProjectController::class, 'toggleFeatured'])->name('projects.toggle-featured');
    Route::post('projects/{project}/toggle-published', [ProjectController::class, 'togglePublished'])->name('projects.toggle-published');
    
    // Articles Management
    Route::resource('articles', ArticleController::class);
    Route::post('articles/{article}/toggle-published', [ArticleController::class, 'togglePublished'])->name('articles.toggle');
    Route::get('articles/categories', [ArticleController::class, 'categories'])->name('articles.categories');
    Route::post('articles/categories', [ArticleController::class, 'storeCategory'])->name('articles.categories.store');
    Route::delete('articles/categories/{category}', [ArticleController::class, 'destroyCategory'])->name('articles.categories.destroy');
    
    // Bookings/Schedules Management
    Route::resource('bookings', BookingController::class);
    Route::get('calendar', [BookingController::class, 'calendar'])->name('calendar');
    Route::post('bookings/{booking}/approve', [BookingController::class, 'approve'])->name('bookings.approve');
    Route::post('bookings/{booking}/decline', [BookingController::class, 'decline'])->name('bookings.decline');
    Route::post('bookings/{booking}/complete', [BookingController::class, 'complete'])->name('bookings.complete');
    Route::get('availability', [BookingController::class, 'availability'])->name('availability');
    Route::post('availability/store', [BookingController::class, 'storeAvailability'])->name('availability.store');
    
    // Contacts/Inquiries
    Route::resource('contacts', ContactController::class)->only(['index', 'show', 'destroy']);
    Route::post('contacts/{contact}/reply', [ContactController::class, 'reply'])->name('contacts.reply');
    Route::post('contacts/{contact}/mark-as', [ContactController::class, 'markAs'])->name('contacts.mark');
    Route::post('contacts/bulk-action', [ContactController::class, 'bulkAction'])->name('contacts.bulk');
    
    // Testimonials
    Route::resource('testimonials', TestimonialController::class);
    Route::post('testimonials/reorder', [TestimonialController::class, 'reorder'])->name('testimonials.reorder');
    Route::post('testimonials/{testimonial}/toggle-featured', [TestimonialController::class, 'toggleFeatured'])->name('testimonials.toggle');
    
    // Tools Management
    Route::resource('tools', ToolController::class)->only(['index', 'edit', 'update']);
    Route::post('tools/{tool}/toggle', [ToolController::class, 'toggle'])->name('tools.toggle');
    Route::get('tools/stats', [ToolController::class, 'stats'])->name('tools.stats');
    
    // Insights/Analytics
    Route::prefix('insights')->name('insights.')->group(function () {
        Route::get('/', [InsightController::class, 'index'])->name('index');
        Route::get('visitors', [InsightController::class, 'visitors'])->name('visitors');
        Route::get('page-views', [InsightController::class, 'pageViews'])->name('page-views');
        Route::get('popular-content', [InsightController::class, 'popularContent'])->name('popular');
        Route::get('export', [InsightController::class, 'export'])->name('export');
    });
    
    // Media Library
    Route::prefix('media')->name('media.')->group(function () {
        Route::get('/', [MediaController::class, 'index'])->name('index');
        Route::post('upload', [MediaController::class, 'upload'])->name('upload');
        Route::delete('{media}', [MediaController::class, 'destroy'])->name('destroy');
        Route::post('folder/create', [MediaController::class, 'createFolder'])->name('folder.create');
        Route::delete('folder/{folder}', [MediaController::class, 'deleteFolder'])->name('folder.delete');
        Route::post('bulk-delete', [MediaController::class, 'bulkDelete'])->name('bulk-delete');
    });
    
    // Users Management
    Route::resource('users', UserController::class);
    Route::post('users/{user}/toggle-status', [UserController::class, 'toggleStatus'])->name('users.toggle');
    Route::post('users/{user}/assign-role', [UserController::class, 'assignRole'])->name('users.role');
    
    // Settings
    Route::prefix('settings')->name('settings.')->group(function () {
        Route::get('/', [SettingController::class, 'index'])->name('index');
        Route::post('general', [SettingController::class, 'updateGeneral'])->name('general');
        Route::post('seo', [SettingController::class, 'updateSeo'])->name('seo');
        Route::post('email', [SettingController::class, 'updateEmail'])->name('email');
        Route::post('social', [SettingController::class, 'updateSocial'])->name('social');
        Route::post('backup', [SettingController::class, 'backup'])->name('backup');
        Route::get('logs', [SettingController::class, 'logs'])->name('logs');
    });
});