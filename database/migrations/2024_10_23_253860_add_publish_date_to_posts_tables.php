<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublishDateToPostsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->date('publish_date')->nullable()->after('status');
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->date('publish_date')->nullable()->after('status');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('achievements', function (Blueprint $table) {
            $table->dropColumn('publish_date');
        });

        Schema::table('announcements', function (Blueprint $table) {
            $table->dropColumn('publish_date');
        });
    }
}
