<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignPublications extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('publications', function (Blueprint $table) {
      $table->foreign('user_id')->references('id')->on('users');
      $table->foreign('type_id')->references('id')->on('types');
      $table->foreign('kind_id')->references('id')->on('kinds');
      $table->foreign('education_id')->references('id')->on('educations');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('publications', function (Blueprint $table) {
      $table->dropForeign('publications_user_id_foreign');
      $table->dropForeign('publications_type_id_foreign');
      $table->dropForeign('publications_kind_id_foreign');
      $table->dropForeign('publications_education_id_foreign');
    });
  }
}
