<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
class SeedEducations extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $educations = [
          '1 класс',
          '2 класс',
          '3 класс',
          '4 класс'
        ];

        foreach ($educations as $education) {
          DB::table('educations')->insert([
             'name' => $education
          ]);
        }

    }
}
