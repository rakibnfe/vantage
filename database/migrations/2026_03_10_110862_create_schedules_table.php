<?php
// database/migrations/2024_01_01_000001_create_schedules_table.php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('schedules', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('description')->nullable();
            $table->enum('type', ['appointment', 'blocked', 'availability'])->default('appointment');
            $table->enum('status', ['scheduled', 'confirmed', 'completed', 'cancelled'])->default('scheduled');
            
            // DateTime fields
            $table->dateTime('start_time');
            $table->dateTime('end_time');
            $table->boolean('is_all_day')->default(false);
            
            // Recurrence
            $table->boolean('is_recurring')->default(false);
            $table->enum('recurrence_pattern', ['none', 'daily', 'weekly', 'biweekly', 'monthly', 'yearly'])->default('none');
            $table->json('recurrence_days')->nullable(); // For weekly: ["monday", "wednesday"]
            $table->date('recurrence_until')->nullable();
            
            // Customer info (for appointments)
            $table->string('customer_name')->nullable();
            $table->string('customer_email')->nullable();
            $table->string('customer_phone')->nullable();
            $table->text('customer_notes')->nullable();
            
            // Metadata
            $table->json('metadata')->nullable(); // For additional data like color, location, etc.
            $table->string('color')->nullable();
            $table->string('location')->nullable();
            
            // Relations
            $table->foreignId('user_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('offering_id')->nullable()->constrained()->nullOnDelete();
            
            $table->timestamps();
            $table->softDeletes();
            
            // Indexes
            $table->index(['start_time', 'end_time']);
            $table->index(['status', 'type']);
            $table->index('slug');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('schedules');
    }
};