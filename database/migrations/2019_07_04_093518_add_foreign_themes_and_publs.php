<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignThemesAndPubls extends Migration
{
  /**
   * Run the migrations.
   *
   * @return void
   */
  public function up()
  {
    Schema::table('themes_and_publ', function (Blueprint $table) {
      $table->foreign('publ_id')->references('id')->on('publications');
      $table->foreign('themes_id')->references('id')->on('themes');
    });
  }

  /**
   * Reverse the migrations.
   *
   * @return void
   */
  public function down()
  {
    Schema::table('themes_and_publ', function (Blueprint $table) {
      $table->dropForeign('themes_and_publ_themes_id_foreign');
      $table->dropForeign('themes_and_publ_publ_id_foreign');
    });
  }
}
