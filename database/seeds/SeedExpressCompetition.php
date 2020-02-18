<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SeedExpressCompetition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('express_competitions')->insert(
            [
                'title' => 'Зимние забавы',
                'annotation' => 'В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие. Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в конкурсах для педагогов',
                'type_id' => 1,
                'cover' => '---',
                'substrate_id' => 1
            ]
        );
    }
}
