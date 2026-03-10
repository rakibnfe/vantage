<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->string('tagline');
            $table->string('icon')->nullable();
            $table->string('featured_image')->nullable();
            $table->text('overview');
            $table->text('description')->nullable();
            $table->json('process')->nullable();
            $table->json('features')->nullable();
            $table->json('technologies')->nullable();
            $table->json('pricing_models')->nullable();
            $table->json('faqs')->nullable();
            $table->json('related_projects')->nullable();
            $table->text('success_stories')->nullable();
            $table->string('delivery_timeframe')->nullable();
            $table->string('team_size')->nullable();
            $table->string('consultation_url')->nullable();
            $table->string('meta_title')->nullable();
            $table->string('meta_description')->nullable();
            $table->boolean('is_published')->default(true);
            $table->boolean('is_featured')->default(false);
            $table->integer('order')->default(0);
            $table->timestamp('published_at')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('services');
    }
};
