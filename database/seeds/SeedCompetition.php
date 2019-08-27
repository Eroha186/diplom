<?php

use Illuminate\Database\Seeder;

class SeedCompetition extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('competitions')->insert([
            'title' => 'Зимние забавы',
            'annotation' => 'В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие. Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в конкурсах для педагогов',
            'type_id' => 1,
            'cover' => '---',
            'date_begin' => date('Y-m-d H:i:s'),
            'date_end' => date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 7),
        ]);
        DB::table('competitions')->insert([
            'title' => 'Новогодний конкурс',
            'annotation' => 'В настоящем разделе представлены актуальные конкурсы, на которые осуществляется прием заявок на участие. Участвуйте вместе с детьми и в конкурсах для педагогов на участие. Участвуйте вмместе с детьми и в конкурсах для педагогов',
            'cover' => '---',
            'type_id' => 1,
            'date_begin' => date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 2),
            'date_end' => date('Y-m-d H:i:s', time() + 60 * 60 * 24 * 7),
        ]);


    }
}
