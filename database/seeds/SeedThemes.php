<?php

use Illuminate\Database\Seeder;

class SeedThemes extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    for ($i = 0; $i < 10; $i++) {
      DB::table('themes')->insert(
          [
              'name' => str_random(10)
          ]
      );
    }
  }
}
