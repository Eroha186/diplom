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
        'files',
    ];

    public function order(Response $response, $column, $filter, $repeatSearch = 0)
    {
        if ($repeatSearch) {
            Cookie::queue(Cookie::make('filter', $filter));
            Cookie::queue(Cookie::make('column', $column));
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

    public function search(Request $request, $searchQuery = '')
    {
        $publicationModel = new Publication();
        $filter = $request->cookie('filter');
        $column = $request->cookie('column');
        $whereArray = [
            ['title', 'LIKE', '%' . $searchQuery . '%']
        ];
        $filters = [
            'education' => $request->get('education'),
            'type' => $request->get('type'),
            'kind' => $request->get('kind'),
            'theme' => $request->get('theme'),
        ];
        foreach ($filters as $filterName => $filterValue) {
            if ($filterValue != 0) {
                $whereArray[] = [$filterName . '_id', $filterValue];
            } else {
                continue;
            }
        }
        $publications = [];
        if ($filter == 1) {
            $publications = $publicationModel::with($this->field)
                ->leftJoin('themes_and_publ as tap', 'publications.id', '=', 'tap.publ_id')
                ->where($whereArray)
                ->groupBy('id')
                ->get();
        } else {
            switch ($filter) {
                case 2:
                    $publications = $publicationModel::with($this->field)
                        ->leftJoin('themes_and_publ as tap', 'publications.id', '=', 'tap.publ_id')
                        ->where($whereArray)
                        ->orderBy($column, 'ASC')
                        ->groupBy('id')
                        ->get();
                    break;
                case 3:
                    $publications = $publicationModel::with($this->field)
                        ->leftJoin('themes_and_publ as tap', 'publications.id', '=', 'tap.publ_id')
                        ->where($whereArray)
                        ->orderBy($column, 'DESC')
                        ->groupBy('id')
                        ->get();
                    break;
            }
        }
        if ($publications->isEmpty()) {
            return response()->json(['error' => 'Нет записей подходящих условию поиска'], 200);
        } else {
            return response()->json($this->formationSnippet($publications), 200);
        }
    }

    public function filter(Request $request)
    {

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
