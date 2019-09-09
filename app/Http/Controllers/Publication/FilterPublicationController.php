<?php

namespace App\Http\Controllers\Publication;

use App\Education;
use App\Http\Controllers\Controller;
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
        Cookie::queue(Cookie::make('filter-p', $filter));
        Cookie::queue(Cookie::make('column-p', $column));
        return $response->status();
    }

    public function search(Request $request, Publication $publicationModel)
    {
        $searchQuery = $request->get('searchQuery');

        $filter = $request->cookie('filter-p');
        $column = $request->cookie('column-p');

        $whereArray = [
            ['title', 'LIKE', '%' . trim($searchQuery) . '%']
        ];

        $filters = [
            'education' => $request->get('education'),
            'type' => $request->get('type'),
            'kind' => $request->get('kind'),
            'theme' => $request->get('theme'),
        ];

        session(['searchQuery' => $searchQuery]);
        foreach ($filters as $filterName => $filterValue) {

            if ($filterValue != 0) {
                $whereArray[] = [$filterName . '_id', $filterValue];
            } else {
                continue;
            }
        }

        $publications = [];
        switch ($filter) {
            case 1:
            case null:
                $publications = $publicationModel::with($this->field)
                    ->where('moderation', 1)
                    ->leftJoin('themes_and_publ as tap', 'publications.id', '=', 'tap.publ_id')
                    ->where($whereArray)
                    ->groupBy('id')
                    ->paginate(10);
                break;
            case 2:
                $publications = $publicationModel::with($this->field)
                    ->where('moderation', 1)
                    ->leftJoin('themes_and_publ as tap', 'publications.id', '=', 'tap.publ_id')
                    ->where($whereArray)
                    ->orderBy($column, 'ASC')
                    ->groupBy('id')
                    ->paginate(10);
                break;
            case 3:
                $publications = $publicationModel::with($this->field)
                    ->where('moderation', 1)
                    ->leftJoin('themes_and_publ as tap', 'publications.id', '=', 'tap.publ_id')
                    ->where($whereArray)
                    ->orderBy($column, 'DESC')
                    ->groupBy('id')
                    ->paginate(10);
                break;
        }
        $publications->withPath(route('search') . '?education=' . $filters['education']
            . '&kind=' . $filters['kind']
            . '&theme=' . $filters['theme']
            . '&type=' . $filters['type']
            . '&searchQuery=' . $searchQuery);

        $educations = Education::all();
        $types = Type::all();
        $kinds = Kind::all();
        $themes = Theme::all();
        $filtersInfo['filter-p'] = $filter;
        $filtersInfo['column-p'] = $column;
        $publications = $this->formationSnippetList($publications);

        if (count($publications)) {
            return view('publication/publications', [
                'publications' => $publications,
                'educations' => $educations,
                'kinds' => $kinds,
                'types' => $types,
                'themes' => $themes,
                'filtersInfo' => $filtersInfo
            ]);
        } else {
            $publications->error = 'Нет публикаций удовлетворяющих критериям поиска';
            return view('publication/publications', [
                'publications' => $publications,
                'educations' => $educations,
                'kinds' => $kinds,
                'types' => $types,
                'themes' => $themes,
                'filtersInfo' => $filtersInfo
            ]);
        }
    }

    public function formationSnippetList($publications)
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

        return $publications;
    }

}
