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
    public function show( Request $request) {
        $filter = $request->cookie('filter-express');
        $column = $request->cookie('column-express');

        $searchQuery = $request->get('search');
        $competitions = [];
        switch ($filter) {
            case 1:
            case null:
                $competitions = ExpressCompetition::where('title', 'LIKE', '%'.$searchQuery.'%')->paginate(16);
                break;
            case 2:
                $competitions = ExpressCompetition::where('title', 'LIKE', '%'.$searchQuery.'%')->orderBy($column, 'ASC')->paginate(16);
                break;
            case 3:
                $competitions = ExpressCompetition::where('title', 'LIKE', '%'.$searchQuery.'%')->orderBy($column, 'DESC')->paginate(16);
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
