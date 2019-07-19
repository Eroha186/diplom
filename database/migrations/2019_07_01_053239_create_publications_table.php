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
			$table->unsignedInteger('user_id');
			$table->string('title');
			$table->string('annotation');
			$table->unsignedInteger('type_id');
			$table->unsignedInteger('kind_id');
			$table->unsignedInteger('education_id');
			$table->text('text');
			$table->integer('moderation');
			$table->timestamp('date_add')->nullable();
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
