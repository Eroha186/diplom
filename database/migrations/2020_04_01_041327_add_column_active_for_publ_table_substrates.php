<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnActiveForPublTableSubstrates extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('substrates', function (Blueprint $table) {
            $table->boolean('active_for_publ')->default(false)->comment("Показывает активную подложку для дипломов о пулбикации");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('substrates', function (Blueprint $table) {
            $table->dropColumn('active_for_publ');
        });
    }
}
