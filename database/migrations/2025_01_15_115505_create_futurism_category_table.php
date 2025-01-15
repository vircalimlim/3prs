<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('futurism_category', function (Blueprint $table) {
            $table->id();
            $table->string('name');
        });

        DB::table('futurism_category')->insert([
            'name' => 'innovation',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'futurism',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'social',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'empowerment',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'learning',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'environmental',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'initiatives',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'researches',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('futurism_category');
    }
};
