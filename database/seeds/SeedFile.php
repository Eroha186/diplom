<?php

use Illuminate\Database\Seeder;

class SeedFile extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 50; $i++) {
            DB::table('files')->insert([
                'publ_id' => $i,
                'url' => 'upload/test.png',
                'type' => 'doc',
                'work_id' => $i,
            ]);
        }
    }
}
