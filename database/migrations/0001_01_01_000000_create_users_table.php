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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('student_id');
            $table->unsignedBigInteger('semester_id');
            $table->string('user_key', 10)->unique();
            $table->string('name');
            $table->string('email');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
            $table->timestamps();
        });

        Schema::create('password_reset_tokens', function (Blueprint $table) {
            $table->string('user_key')->primary();
            $table->string('token');
            $table->timestamp('created_at')->nullable();
        });

        Schema::create('sessions', function (Blueprint $table) {
            $table->string('id')->primary();
            $table->foreignId('user_id')->nullable()->index();
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();
            $table->longText('payload');
            $table->integer('last_activity')->index();
        });

        DB::table('users')->insert(
            array(
                [
                    'student_id'    => 0,
                    'semester_id'   => 0,
                    'user_key'      => '1000000000',
                    'name' => 'admin admin',
                    'email' => 'admin@gmail.com',
                    'password' => '$2y$12$0ZB9uqbJL/xBrIlVA8Glxe4Iw8hI25mKkt4yxjgUAtg7tc8Xt/SYC',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            )
        );

        DB::table('users')->insert(
            array(
                [
                    'student_id'    => 0,
                    'semester_id'   => 0,
                    'user_key'      => '2000000000',
                    'name' => 'admin admin',
                    'email' => 'admin2@gmail.com',
                    'password' => '$2y$12$0ZB9uqbJL/xBrIlVA8Glxe4Iw8hI25mKkt4yxjgUAtg7tc8Xt/SYC',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            )
        );

        DB::table('users')->insert(
            array(
                [
                    'student_id'    => 0,
                    'semester_id'   => 0,
                    'user_key'      => '3000000000',
                    'name' => 'admin admin',
                    'email' => 'admin3@gmail.com',
                    'password' => '$2y$12$0ZB9uqbJL/xBrIlVA8Glxe4Iw8hI25mKkt4yxjgUAtg7tc8Xt/SYC',
                    'created_at' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s'),
                ],
            )
        );
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
        Schema::dropIfExists('password_reset_tokens');
        Schema::dropIfExists('sessions');
    }
};
