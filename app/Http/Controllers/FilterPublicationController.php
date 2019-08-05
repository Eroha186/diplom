<?php

namespace App\Http\Controllers;

use App\Education;
use App\Kind;
use App\Publication;
use App\Theme;
use App\Type;
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

    public function setCookieOrder(Response $response, $column, $filter)
    {
        Cookie::queue(Cookie::make('filter', $filter));
        Cookie::queue(Cookie::make('column', $column));
        return $response->status();
    }

    public function search(Request $request, $searchQuery = '')
    {
        session(['searchQuery' => $searchQuery]);
        $publicationModel = new Publication();
        $filter = $request->cookie('filter');
        $column = $request->cookie('column');
        $whereArray = [
            ['title', 'LIKE', '%' . trim($searchQuery) . '%']
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
                ->paginate(10);
        } else {
            switch ($filter) {
                case 2:
                    $publications = $publicationModel::with($this->field)
                        ->leftJoin('themes_and_publ as tap', 'publications.id', '=', 'tap.publ_id')
                        ->where($whereArray)
                        ->orderBy($column, 'ASC')
                        ->groupBy('id')
                        ->paginate(10);
                    break;
                case 3:
                    $publications = $publicationModel::with($this->field)
                        ->leftJoin('themes_and_publ as tap', 'publications.id', '=', 'tap.publ_id')
                        ->where($whereArray)
                        ->orderBy($column, 'DESC')
                        ->groupBy('id')
                        ->paginate(10);
                    break;
            }
        }
        $publications->withPath('publications/');

        if (!count($publications)) {
            return response()->json(['error' => 'Нет записей подходящих условию поиска'], 200);
        } else {
            return response()->json($this->formationSnippet($publications), 200);
        }
    }

    public function formationSnippet($publications, $flag = 1)
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
        if ($flag) {
            $html = view('publication.publication-snippet', ['publications' => $publications])->render();
            return $html;
        } else {
            return $publications;
        }
    }

}
