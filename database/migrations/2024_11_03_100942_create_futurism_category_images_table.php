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
        Schema::create('futurism_category_images', function (Blueprint $table) {
            $table->id();
            $table->enum('category', ['innovation', 'futurism', 'social', 'empowerment', 'learning', 'environmental', 'initiatives', 'researches']);
            $table->string('image');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('futurism_category_images');
    }
};
