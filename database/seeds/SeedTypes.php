<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SeedTypes extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = [
          'Фоторабота',
          'Рисунок',
          'Поделка',
          'Сочинение'
        ];

        foreach ($types as $type) {
          DB::table('types')->insert([
              'name' => $type
          ]);
        }
    }
}
