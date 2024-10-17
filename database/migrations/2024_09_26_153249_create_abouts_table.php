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
        Schema::create('abouts', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('thumbnail');
            $table->enum('category', ['about', 'mission', 'vision', 'objectives', 'org-chart']);
        });

        DB::table('abouts')->insert(
            array(
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'about',
                ],   
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'mission',
                ],   
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'vision',
                ],   
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'objectives',
                ],   
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'org-chart',
                ],  
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('about');
    }
};
