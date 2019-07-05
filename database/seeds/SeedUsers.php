<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedUsers extends Seeder
{
  /**
   * Run the database seeds.
   *
   * @return void
   */
  public function run()
  {
    $name = [
        'Иван',
        'Петр',
        'Роман',
        'Дмитрий'
    ];
    $surName = [
        'Иванов',
        'Петров',
        'Романов',
        'Дмитриев',
    ];
    $kristianName = [
        'Иванович',
        'Петрович',
        'Романович',
        'Дмитриев',
    ];
    for($i = 0; $i < 4; $i++) {
      DB::table('users')->insert([
          'f' => $name[$i],
          'i' => $surName[$i],
          'o' => $kristianName[$i],
          'email' => str_random(10) . '@mail.ru',
          'password' => password_hash('admin', PASSWORD_DEFAULT),
          'stuff' => 'МБОУ СОШ № 11',
          'town' => 'Абакан',
          'job' => 'Препод',
          'confirm' => 1,
          'date_reg' => date('Y-m-d H:i:s')
      ]);
    }
  }
}
