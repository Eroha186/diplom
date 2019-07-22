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
      $data = [
          'День учителя',
          'Динозавры',
          'Какая-нибудь лабуда',
          'Разное',
      ];

      foreach ($data as $one) {
          DB::table('themes')->insert([
              'name' => $one
          ]);
      }
  }
}
