<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnStatusCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->tinyInteger('status')->default(0)->comment('0 - конкурс идет; 1 - работы на проверке; 2 - конкурс завершен');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competitions', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
