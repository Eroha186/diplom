<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMailingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('mailings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('template_id');
            $table->string('theme');
            $table->integer('number_mail')->comment('Число отправленных сообщений');
            $table->integer('all_mail')->comment('Общее число сообщений в рассылке');
            $table->tinyInteger('status')->comment('Статус: 1 - в работе, 2 - завершена, 3 - отменена');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('mailings');
    }
}
