<?php


namespace App\Repositories;


use App\Diplom;

class DiplomRepository
{
    public function create($work_id, $type)
    {
        return Diplom::create([
            'work_id' => $work_id,
            'type' => $type,
        ]);
    }
}