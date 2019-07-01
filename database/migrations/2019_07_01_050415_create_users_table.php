<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('users', function (Blueprint $table) {
			$table->increments('id');
			$table->string('f', 30);
			$table->string('i', 30);
			$table->string('o', 30);
			$table->string('email', 50);
			$table->string('password', 32);
			$table->string('salt');
			$table->string('stuff', 100);
			$table->string('town',50);
			$table->string('job');
			$table->integer('confirm');
			$table->timestamp('date_reg');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('users');
	}
}
