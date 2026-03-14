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
        Schema::create('offering_pricing_models', function (Blueprint $table) {
            $table->id();
            $table->foreignId('offering_id')->constrained('offerings')->cascadeOnDelete();
            $table->string('name');
            $table->text('description');
            $table->decimal('starting_price', 10, 2)->nullable();
            $table->text('notes')->nullable();
            $table->integer('order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('offering_pricing_models');
    }
};
