<?php

namespace App\Http\Controllers\Competitions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class FilterCompetitionController extends Controller
{
    public function setCookieOrder(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter-c', $filter));
        Cookie::queue(Cookie::make('column-c', $column));
        return $response->status();
    }

    public function search(Request $request) {

    }
}
