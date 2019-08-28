<?php

namespace App\Http\Controllers\Competitions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Competition;

class CompetitionsController extends Controller
{
    public function show() {
        $competitions = Competition::all();
        foreach ($competitions as $competition) {
            $competition['date_begin'] =  date("d.m.Y", strtotime($competition['date_begin']));
            $competition['date_end'] =  date("d.m.Y", strtotime($competition['date_end']));
        }
        return view('competitions/competitions', ['competitions' => $competitions]);
    }

    public function showCompetition($id) {
        return view('competitions/competition', ['id' => $id]);
    }

}
