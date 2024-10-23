<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPublishDateToFuturismsTable extends Migration
{
    public function up()
    {
        Schema::table('futurisms', function (Blueprint $table) {
            $table->date('publish_date')->nullable()->after('status');
        });
    }

    public function down()
    {
        Schema::table('futurisms', function (Blueprint $table) {
            $table->dropColumn('publish_date');
        });
    }
}
