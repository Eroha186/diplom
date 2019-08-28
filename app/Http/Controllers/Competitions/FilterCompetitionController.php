<?php

namespace App\Http\Controllers\Competitions;

use App\Competition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\DB;

class FilterCompetitionController extends Controller
{
    public function setCookieOrder(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter-c', $filter));
        Cookie::queue(Cookie::make('column-c', $column));
        return $response->status();
    }

    public function search(Request $request, Competition $competitionModel) {
        $filter = $request->cookie('filter-c');
        $column = $request->cookie('column-c');

        $searchQuery = $request->get('searchQuery');
        $competitions = [];
        if($column != 'difference-date') {
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
                        ->orderBy(DB::raw('date_end - date_begin'), 'DESC' )
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

    public function formationSnippet($competitions) {
        foreach ($competitions as $competition) {
            $competition['date_begin'] =  date("d.m.Y", strtotime($competition['date_begin']));
            $competition['date_end'] =  date("d.m.Y", strtotime($competition['date_end']));
        }

        return $competitions;
    }
}
