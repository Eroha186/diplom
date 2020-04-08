<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class CookiesController extends Controller
{
    public function setCookieOrderPublication(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter-p', $filter));
        Cookie::queue(Cookie::make('column-p', $column));
        return $response->status();
    }

    public function setCookieOrderCompetitions(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter-c', $filter)); //competitions
        Cookie::queue(Cookie::make('column-c', $column));
        return $response->status();
    }
    public function setCookieOrderArchCompetition(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter-ac', $filter)); //arch - competitions
        Cookie::queue(Cookie::make('column-ac', $column));
        return $response->status();
    }

    public function setCookieOrderCompetition(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter-competition', $filter));
        Cookie::queue(Cookie::make('column-competition', $column));
        return $response->status();
    }

    public function setCookieFilterNomination(Response $response, $valueFilter)
    {
        Cookie::queue(Cookie::make('filter-nomination', $valueFilter));
        return $response->status();
    }
}
