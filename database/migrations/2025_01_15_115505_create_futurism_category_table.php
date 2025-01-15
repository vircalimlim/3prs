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
            'name' => 'AVInnovation',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'Futurism',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'Social Impact',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'Women Empowerment',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'Learning Development',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'Environmental Projects',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'Student Initiatives',
        ]);

        DB::table('futurism_category')->insert([
            'name' => 'Researches',
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
