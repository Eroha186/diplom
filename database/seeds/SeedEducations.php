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
            'Дошкольники',
            '1 класс',
            '2 класс',
            '3 класс',
            '4 класс',
            '5 класс',
            '6 класс',
            '7 класс',
            '8 класс',
            '9 класс',
            '10 класс',
            '11 класс',
        ];

        foreach ($educations as $education) {
            DB::table('educations')->insert([
                'name' => $education
            ]);
        }

    }
}
