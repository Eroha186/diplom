<?php

namespace App\Http\Controllers\Competitions;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Nomination;
use App\Repositories\CompetitionRepository;
use App\Repositories\Works\WorkRepository;
use App\Work;
use App\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompetitionsController extends Controller
{
    public function __construct()
    {
        $this->competitionRepository = new CompetitionRepository();
        $this->workRepository = new WorkRepository();
    }

    public function showCompetitions(Request $request, Competition $competitionModel)
    {
        $filter = $request->cookie('filter-c');
        $column = $request->cookie('column-c');

        $competitions = [];
        $columnOrderBy = $column == 'difference-date' ? DB::raw('date_end - date_begin') : $column;
        switch ($filter) {
            case null:
            case 1:
                $competitions = $this->competitionRepository->getAllRelevantCompetitionOrderBy('id', 'ASC');
                break;
            case 2:
                $competitions = $this->competitionRepository->getAllRelevantCompetitionOrderBy($columnOrderBy, 'ASC');
                break;
            case 3:
                $competitions = $this->competitionRepository->getAllRelevantCompetitionOrderBy($columnOrderBy, 'DESC');
                break;
        }

        $filterInfo = [
            'column-c' => $column,
            'filter-c' => $filter,
        ];

        return view('competitions/competitions', [
            'competitions' => $competitions,
            'filterInfo' => $filterInfo
        ]);
    }

    public function showArchCompetitions(Request $request, Competition $competitionModel)
    {
        $filter = $request->cookie('filter-ac');
        $column = $request->cookie('column-ac');

        $competitions = [];
        $columnOrderBy = $column == 'difference-date' ? DB::raw('date_end - date_begin') : $column;
        switch ($filter) {
            case null:
            case 1:
                $competitions = $this->competitionRepository->getEndedCompetitions('id', 'ASC');
                break;
            case 2:
                $competitions = $this->competitionRepository->getEndedCompetitions($columnOrderBy, 'ASC');
                break;
            case 3:
                $competitions = $this->competitionRepository->getEndedCompetitions($columnOrderBy, 'DESC');
                break;
        }

        $filterInfo = [
            'column-ac' => $column,
            'filter-ac' => $filter,
        ];

        return view('competitions/arch-competitions', [
            'competitions' => $competitions,
            'filterInfo' => $filterInfo
        ]);
    }

    public function showCompetition(Request $request, $id)
    {
        $filter = $request->cookie('filter-competition');
        $column = $request->cookie('column-competition');
        $valueFilterNomination = $request->cookie('filter-nomination');

        $filterInfo = [
            'column-competition' => $column,
            'filter-competition' => $filter,
            'nomination' => $valueFilterNomination,
        ];

        $competition = $this->competitionRepository->getCompetition($id);
        $works = $this->workRepository->getWorkForCompetition($id);
        $works->count = $this->workRepository->getCountWorksInCompetition($id);

        return view('competitions/competition', [
            'id' => $id,
            'works' => $works,
            'competition' => $competition,
            'filterInfo' => $filterInfo
        ]);
    }

}
