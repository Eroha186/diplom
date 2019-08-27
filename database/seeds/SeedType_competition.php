<?php

use Illuminate\Database\Seeder;

class SeedType_competition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
          'Конкурс рисунков',
          'Конкурс сочинений',
          'Конкурс презентаций',
        ];

        foreach ($array as $one) {
            DB::table('type_competition')->insert([
               'name' => $one,
            ]);
        }
    }
}
