<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableHistoryUnsubscribe extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('history_unsubscribe', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->integer('event')->comment('0 - подписка, 1 - отписка');
            $table->timestamp('date_add');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
