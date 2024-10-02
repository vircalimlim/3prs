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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->text('description');
            $table->string('thumbnail');
            $table->enum('category', ['section1', 'section2', 'section3', 'section4']);
        });

        DB::table('sections')->insert(
            array(
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'section1',
                ],   
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'section2',
                ],   
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'section3',
                ],   
                [
                    'description'   => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Libero ut, delectus labore dolores eum porro laudantium deleniti optio itaque eius nemo, unde maxime vel harum quisquam dolorem quidem commodi facilis. Obcaecati doloremque quidem animi! Dolore, qui labore. Unde, dolores? Laborum dicta ipsa dolores fuga ratione id quo repellendus aut eveniet!',
                    'thumbnail'     => 'hero.png',
                    'category'      => 'section4',
                ],   
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
