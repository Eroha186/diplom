<?php

namespace App\Http\Controllers\Competitions;

use App\Competition;
use App\Http\Controllers\SearchController;
use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class FilterCompetitionController extends Controller
{
    public function search(Request $request, Competition $competitionModel)
    {
        $filter = $request->cookie('filter-c');
        $column = $request->cookie('column-c');

        $searchQuery = $request->get('searchQuery');
        $competitions = [];
        $competitionQueryArray = new SearchController();
        $competitionQueryArray = $competitionQueryArray->search($searchQuery, [
            'competition' => $competitionModel,
        ]);

        session(['searchQueryC' => $searchQuery]);

        $competitionQueryModel = $competitionQueryArray['model'] ?? $competitionQueryArray;
        if ($column != 'difference-date') {
            switch ($filter) {
                case 1:
                case null:
                    $competitions = $competitionQueryModel;
                    break;
                case 2:
                    $competitions = $competitionQueryModel
                        ->orderBy($column, 'ASC');
                    break;
                case 3:
                    $competitions = $competitionQueryModel
                        ->orderBy($column, 'DESC');
                    break;
            }
        } else {
            switch ($filter) {
                case 1:
                case null:
                    $competitions = $competitionQueryModel;
                    break;
                case 2:
                    $competitions = $competitionQueryModel
                        ->orderBy(DB::raw('date_end - date_begin'), 'ASC');
                    break;
                case 3:
                    $competitions = $competitionQueryModel
                        ->orderBy(DB::raw('date_end - date_begin'), 'DESC');
                    break;
            }
        }
        $competitions = is_null($competitionQueryArray['query'])
            ? $competitions->paginate(10, array('*'))
            : $competitions->paginate(10, array('*', $competitionQueryArray['query']));
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

        $field = [
            'user',
            'file',
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
        $nominations = Competition::with("nominations")->where('id', $id)->get();
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
