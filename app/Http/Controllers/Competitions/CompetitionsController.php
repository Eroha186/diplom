<?php

namespace App\Http\Controllers\Competitions;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Work;
use App\File;

class CompetitionsController extends Controller
{
    public function show()
    {
        $competitions = Competition::all();
        foreach ($competitions as $competition) {
            $competition['date_begin'] = date("d.m.Y", strtotime($competition['date_begin']));
            $competition['date_end'] = date("d.m.Y", strtotime($competition['date_end']));
        }
        return view('competitions/competitions', ['competitions' => $competitions]);
    }

    public function showCompetition($id)
    {
        $field = [
            'user',
            'file'
        ];

        $works = Work::with($field)->where('competition_id', $id)->get();
        dump($works);
        return view('competitions/competition', ['id' => $id, 'works' => $works]);
    }

}
