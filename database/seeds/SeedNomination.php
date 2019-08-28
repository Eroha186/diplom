<?php

use Illuminate\Database\Seeder;

class SeedNomination extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array = [
            'Педагоги',
            'Дошкольное образование',
            '1-4 класс',
            '5-8 класс',
            '9-11 класс',
        ];

        foreach ($array as $one) {
            DB::table('nominations')->insert([
                'name' => $one,
            ]);
        }
    }
}
