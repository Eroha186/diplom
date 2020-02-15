<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExpressWorkTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('express_works', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('competition_id');
            $table->string('title');
            $table->text('annotation');
            $table->timestamp('date_add');
            $table->string('fc')->nullable();
            $table->string('ic')->nullable();
            $table->string('oc')->nullable();
            $table->integer('age');
            $table->integer('place');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('express_work');
    }
}
