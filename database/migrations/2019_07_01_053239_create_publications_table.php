<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePublicationsTable extends Migration
{
	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('publications', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('id_user');
			$table->string('title');
			$table->string('annatation');
			$table->integer('id_type');
			$table->integer('id_kind');
			$table->integer('id_education');
			$table->text('text');
			$table->integer('moderation');
			$table->timestamps('date_add');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::dropIfExists('publications');
	}
}
