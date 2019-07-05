<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SeedKinds extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $kinds = [
        'Апликация',
        'Конспект',
        'Сказка',
        'Еще что-нибудь'
    ];

    foreach ($kinds as $kind) {
      DB::table('kinds')->insert([
          'name' => $kind
      ]);
    }

  }
}
