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
        Schema::table('futurisms', function (Blueprint $table) {
            $table->enum('category', ['innovation', 'futurism', 'social', 'empowerment', 'learning', 'environmental', 'initiatives', 'researches'])
                ->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('futurisms', function (Blueprint $table) {
            $table->enum('category', ['innovation', 'futurism', 'social', 'empowerment', 'learning', 'environmental', 'initiatives'])
                ->change();
        });
    }
};
