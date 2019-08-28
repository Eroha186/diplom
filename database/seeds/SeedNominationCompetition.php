<?php

use Illuminate\Database\Seeder;

class SeedNominationCompetition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $array1 = [
            1,
            2
        ];
        $array2 = [
          1,
          2,
          3,
          4,
          5,
        ];

        foreach ($array1 as $one) {
            foreach ($array2 as $two) {
                DB::table('competition_nomination')->insert([
                    'competition_id' => $one,
                    'nomination_id' => $two
                ]);
            }
        }
    }
}
