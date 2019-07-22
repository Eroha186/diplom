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
        'Презентации',
        'Конспекты уроков',
        'Рабочие программы/Планирование',
        'Классные часы',
        'Сценарии',
        'Контрольные работы/Тесты',
        'Мастер классы',
        'Разное'
    ];

    foreach ($kinds as $kind) {
      DB::table('kinds')->insert([
          'name' => $kind
      ]);
    }

  }
}
