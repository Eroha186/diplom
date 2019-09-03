<?php

namespace App\Http\Controllers\Competitions;

use App\Competition;
use App\Competition_Nomination;
use App\Http\Controllers\Controller;
use App\Nomination;
use App\Work;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitionsController extends Controller
{
    public function show(Request $request, Competition $competitionModel)
    {
        $filter = $request->cookie('filter-c');
        $column = $request->cookie('column-c');
        $competitions = [];

        if ($column != 'difference-date') {
            switch ($filter) {
                case 1:
                case null:
                    $competitions = $competitionModel->all();
                    break;
                case 2:
                    $competitions = $competitionModel->orderBy($column, 'ASC')->get();
                    break;
                case 3:
                    $competitions = $competitionModel->orderBy($column, 'DESC')->get();
                    break;
            }
        } else {
            switch ($filter) {
                case 1:
                case null:
                    $competitions = $competitionModel->all();
                    break;
                case 2:
                    $competitions = $competitionModel->orderBy(DB::raw('date_end - date_begin'), 'ASC')->get();
                    break;
                case 3:
                    $competitions = $competitionModel->orderBy(DB::raw('date_end - date_begin'), 'DESC')->get();
                    break;
            }
        }

        $filterInfo = [
            'column-c' => $column,
            'filter-c' => $filter,
        ];

        foreach ($competitions as $competition) {
            $competition['date_begin'] = date("d.m.Y", strtotime($competition['date_begin']));
            $competition['date_end'] = date("d.m.Y", strtotime($competition['date_end']));
        }

        return view('competitions/competitions', [
            'competitions' => $competitions,
            'filterInfo' => $filterInfo
        ]);
    }

    public function showCompetition(Request $request,$id)
    {
        $field = [
            'user',
            'file'
        ];

        $filter = $request->cookie('filter-competition');
        $column = $request->cookie('column-competition');
        $valueFilterNomination = $request->cookie('filter-nomination');
        dump($valueFilterNomination);
        $filterInfo = [
            'column-competition' => $column,
            'filter-competition' => $filter,
            'nomination' => $valueFilterNomination,
        ];

        $competition = Competition::where('id', $id)->first();
        $nominations = Competition_Nomination::where('competition_id', $id)
            ->leftJoin('nominations as n', 'n.id', '=', 'nomination_id')
            ->get();
        $works = Work::with($field)->where('competition_id', $id)->paginate(16);
        $works->count = count(Work::where('competition_id', $id)->get());

        return view('competitions/competition', [
            'id' => $id,
            'works' => $works,
            'competition' => $competition,
            'nominations' => $nominations,
            'filterInfo' => $filterInfo
        ]);
    }

}