<?php

use Illuminate\Database\Seeder;

class SeedExpressWork extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i < 30; $i++) {
            DB::table('express_works')->insert([
                'user_id' => 1,
                'competition_id' => 1,
                'title' => 'С 8 марта',
                'annotation' => 'описание',
                'fc' => 'Иван',
                'ic' => 'Иванов',
                'oc' => 'Иванович',
                'nomination_id' => 3,
                'date_add' => date('Y-m-d H:i:s', time()),
                'date_send_mail' => date('Y-m-d H:i:s', strtotime(now()->addDays(2))),
            ]);
        }
    }
}
