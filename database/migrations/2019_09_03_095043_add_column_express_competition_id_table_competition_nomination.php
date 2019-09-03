<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnExpressCompetitionIdTableCompetitionNomination extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('competition_nomination', function (Blueprint $table) {
            $table->integer('express_competition_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('competition_nomination', function (Blueprint $table) {
            $table->dropColumn('express_competition_id');
        });
    }
}
