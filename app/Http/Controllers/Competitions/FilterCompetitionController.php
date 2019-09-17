<?php

namespace App\Http\Controllers\Competitions;

use App\Competition;
use App\Competition_Nomination;
use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class FilterCompetitionController extends Controller
{
    public function setCookieOrderCompetitions(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter-c', $filter)); //competitions
        Cookie::queue(Cookie::make('column-c', $column));
        return $response->status();
    }

    public function setCookieOrderCompetition(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter-competition', $filter));
        Cookie::queue(Cookie::make('column-competition', $column));
        return $response->status();
    }


    public function search(Request $request, Competition $competitionModel)
    {
        $filter = $request->cookie('filter-c');
        $column = $request->cookie('column-c');

        $searchQuery = $request->get('searchQuery');
        $competitions = [];
        if ($column != 'difference-date') {
            switch ($filter) {
                case 1:
                case null:
                    $competitions = $competitionModel->where('title', 'LIKE', '%' . trim($searchQuery) . '%')->get();
                    break;
                case 2:
                    $competitions = $competitionModel->where('title', 'LIKE', '%' . trim($searchQuery) . '%')
                        ->orderBy($column, 'ASC')
                        ->get();
                    break;
                case 3:
                    $competitions = $competitionModel->where('title', 'LIKE', '%' . trim($searchQuery) . '%')
                        ->orderBy($column, 'DESC')
                        ->get();
                    break;
            }
        } else {
            switch ($filter) {
                case 1:
                case null:
                    $competitions = $competitionModel->where('title', 'LIKE', '%' . trim($searchQuery) . '%')->get();
                    break;
                case 2:
                    $competitions = $competitionModel->where('title', 'LIKE', '%' . trim($searchQuery) . '%')
                        ->orderBy(DB::raw('date_end - date_begin'), 'ASC')
                        ->get();
                    break;
                case 3:
                    $competitions = $competitionModel->where('title', 'LIKE', '%' . trim($searchQuery) . '%')
                        ->orderBy(DB::raw('date_end - date_begin'), 'DESC')
                        ->get();
                    break;
            }
        }
        $competitions = $this->formationSnippet($competitions);
        $filterInfo = [
            'filter-c' => $filter,
            'column-c' => $column
        ];
        return view('competitions/competitions', [
            'competitions' => $competitions,
            'filterInfo' => $filterInfo,
        ]);
    }

    public function formationSnippet($competitions)
    {
        foreach ($competitions as $competition) {
            $competition['date_begin'] = date("d.m.Y", strtotime($competition['date_begin']));
            $competition['date_end'] = date("d.m.Y", strtotime($competition['date_end']));
        }

        return $competitions;
    }

    public function setCookieFilterNomination(Response $response, $valueFilter)
    {
        Cookie::queue(Cookie::make('filter-nomination', $valueFilter));
        return $response->status();
    }

    public function searchWork(Request $request, $id)
    {
        $filter = $request->cookie('filter-competition');
        $column = $request->cookie('column-competition');
        $nominationFilter = $request->cookie('filter-nomination');
        $filterInfo = [
            'column-competition' => $column,
            'filter-competition' => $filter,
            'nomination' => $nominationFilter,
        ];
        $works = [];
        $where = [];

        $field = [
            'user',
            'file'
        ];
        if ($nominationFilter == 0) {
            $where = [
                ['competition_id', $id],
            ];

        } else {
            $where = [
                ['competition_id', $id],
                ['nomination_id', $nominationFilter]
            ];

        }
        switch ($filter) {
            case null:
            case 1:
                $works = Work::with($field)->where($where)->paginate(16);
                break;
            case 2:
                $works = Work::with($field)->where($where)->orderBy($column, 'ASC')->paginate(16);
                break;
            case 3:
                $works = Work::with($field)->where($where)->orderBy($column, 'DESC')->paginate(16);
                break;
        }
        $competition = Competition::where('id', $id)->first();
        $nominations = Competition_Nomination::where('competition_id', $id)
            ->leftJoin('nominations', 'nominations.id', '=', 'nomination_id')
            ->get();
        dump($nominations);
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
