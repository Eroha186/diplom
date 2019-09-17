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
        for ($i = 0; $i < 30; $i++) {
            DB::table('files')->insert([
                'publ_id' => 0,
                'url' => 'upload/uSwYaTpVtLzDxObIs93p5LkivlW8sj1I8PUa9E7I.jpeg',
                'type' => 'image',
                'work_id' => $i,
            ]);
        }
    }
}
