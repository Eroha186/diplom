<?php

namespace App\Http\Controllers\Competitions;

use App\ExpressCompetition;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;
use PhpParser\Node\Expr;

class ExpressCompetitionsController extends Controller
{
    public function setCookieFilter(Response $response, $column, $filter) {
        Cookie::queue(Cookie::make('filter-express', $filter)); //competitions
        Cookie::queue(Cookie::make('column-express', $column));
        return $response->status();
    }

    public function show( Request $request) {
        $filter = $request->cookie('filter-competition');
        $column = $request->cookie('column-competition');
        $competitions = [];
        switch ($filter) {
            case 1:
            case null:
                $competitions = ExpressCompetition::with('type')->paginate(16);
                break;
            case 2:
                $competitions = ExpressCompetition::orderBy($column, 'ASC')->paginate(16);
                break;
            case 3:
                $competitions = ExpressCompetition::orderBy($column, 'DESC')->paginate(16);
                break;
        }
        $filterInfo = [
            'column-express' => $column,
            'filter-express' => $filter,
        ];
        return view('express-competitions/express-competitions', [
            'competitions' => $competitions,
            'filterInfo' => $filterInfo
        ]);
    }
}
