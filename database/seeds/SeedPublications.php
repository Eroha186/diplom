<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Faker\Generator as Faker;

class SeedPublications extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = new Faker();
        for($i = 0; $i<50; $i++) {
            DB::table('publications')->insert([
               'user_id' => 1,
                'title' => str_random(12),
                'annotation' => 'описание описание описание',
                'type_id' => random_int(1,4),
                'kind_id' => random_int(1,8),
                'education_id' => random_int(1,12),
                'text' => str_random(200),
                'moderation' => 2,
                'date_add' => date('Y-m-d H:i:s')

            ]);
        }
    }
}
