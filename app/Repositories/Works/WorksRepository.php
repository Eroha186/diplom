<?php


namespace App\Repositories\Works;


class WorksRepository
{
    protected $field = [
        'competition',
        'user',
        'diplom'
    ];

    protected function formatWork($works) {
        foreach ($works as $work) {
            $work['date_add'] = date("d.m.Y", strtotime($work['date_add']));
            $work['user']['i'] = mb_substr($work['user']['i'], 0, 1);
            $work['user']['o'] = mb_substr($work['user']['o'], 0, 1);
            $work['ic'] = mb_substr($work['ic'], 0, 1);
            $work['oc'] = mb_substr($work['oc'], 0, 1);
        }

        return $works;
    }
}