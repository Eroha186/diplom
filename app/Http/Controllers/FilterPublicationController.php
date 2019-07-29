<?php

namespace App\Http\Controllers;

use App\Publication;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Cookie;

class FilterPublicationController extends Controller
{
    protected $field = [
        'author',
        'type',
        'education',
        'theme',
        'kind',
        'files'
    ];

    public function order(Response $response, $column, $filter, $repeatSearch = 0)
    {
        if ($repeatSearch) {
           Cookie::queue(Cookie::make('filter', $filter));
       Cookie::queue(Cookie::make('column', $column));
            // ->withCookie('filter', $filter, 999)->withCookie('column', $column, 999)
            return $response->status();

        }
        $publicationModel = new Publication();
        $publications = [];
        switch ($filter) {
            case 1:
                $publications = $publicationModel::with($this->field)->get();
                break;
            case 2:
                $publications = $publicationModel::with($this->field)->orderBy($column, 'ASC')->get();
                break;
            case 3:
                $publications = $publicationModel::with($this->field)->orderBy($column, 'DESC')->get();
                break;
        }
        Cookie::queue(Cookie::make('filter', $filter));
        Cookie::queue(Cookie::make('column', $column));

        return response()->json($this->formationSnippet($publications), 200);
    }

    public function search(Request $request, $searchQuery)
    {
        $publicationModel = new Publication();
        $filter = $request->cookie('filter');
        $column = $request->cookie('column');
//        dump($filter);
//        dump($column);
        $publications = [];
        if ($filter == 1) {
            $publications = $publicationModel::with($this->field)->where('title', 'LIKE', '%' . $searchQuery . '%')->get();
        } else {
            switch ($filter) {
                case 2:
                    $publications = $publicationModel::with($this->field)
                        ->where('title', 'LIKE', '%' . $searchQuery . '%')
                        ->orderBy($column, 'ASC')
                        ->get();
                    break;
                case 3:
                    $publications = $publicationModel::with($this->field)
                        ->where('title', 'LIKE', '%' . $searchQuery . '%')
                        ->orderBy($column, 'DESC')
                        ->get();
                    break;
            }
        }
        if (!$publications) {
            return response()->json(['error' => 'Нет записей подходящих условию поиска', 'status' => false]);
        } else {
            return response()->json($this->formationSnippet($publications), 200);
        }
    }

    public function formationSnippet($publications)
    {
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['author']['i'] = mb_substr($publication['author']['i'], 0, 1);
            $publication['author']['o'] = mb_substr($publication['author']['o'], 0, 1);
            foreach ($publication['files'] as $file) {
                if ($file['type'] == 'doc') {
                    $publication['doc'] = 1;
                }
                if ($file['type'] == 'ppt') {
                    $publication['ppt'] = 1;
                }
            }
        }
        $html = view('publication.publication-snippet', ['publications' => $publications])->render();
        return $html;
    }

}
