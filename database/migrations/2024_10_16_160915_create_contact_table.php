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
        Schema::create('contact', function (Blueprint $table) {
            $table->id();
            $table->string('fb_name');
            $table->string('fb_link');
            $table->string('email');
        });

        DB::table('contact')->insert(
            array(
                [
                    'fb_name'       => '3PRS RPDO',
                    'fb_link'       => 'https://www.facebook.com',
                    'email'         => '3prsrpdo@gmail.com',
                ], 
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contact');
    }
};
