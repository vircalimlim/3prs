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
        Schema::create('futurisms', function (Blueprint $table) {
            $table->id();
            $table->string('image', 155);
            $table->string('title');
            $table->text('description');
            $table->enum('category', ['innovation', 'futurism', 'social', 'empowerment', 'learning', 'environmental', 'initiatives']);
            $table->enum('status', ['active', 'inactive']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('futurism');
    }
};
