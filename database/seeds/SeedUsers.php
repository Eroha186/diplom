<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedUsers extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'f' => 'Дутов',
            'i' => 'Кузьма',
            'o' => 'Васильевич',
            'email' => 'admin@mail.ru',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'stuff' => 'МБОУ СОШ № 11',
            'town' => 'Абакан',
            'job' => 'Педагог',
            'confirm' => 1,
            'date_reg' => date('Y-m-d H:i:s')]);

    }
}
