<?php

namespace App\Http\Controllers\Publication;

use App\Education;
use App\Http\Controllers\Controller;
use App\Http\Controllers\SearchController;
use App\Kind;
use App\Publication;
use App\Theme;
use App\Type;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Cookie;

class FilterPublicationController extends Controller
{
    protected $field = [
        'user',
        'type',
        'education',
        'themes',
        'kind',
        'files',
    ];

    protected $page = 10;

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
            'moderation' => 2
        ];

        $filters = [
            'education' => $request->get('education'),
            'type' => $request->get('type'),
            'kind' => $request->get('kind'),
            'theme' => $request->get('theme'),
        ];

        session(['searchQueryP' => $searchQuery]);
        foreach ($filters as $filterName => $filterValue) {

            if ($filterValue != 0) {
                $whereArray[] = [$filterName . '_id', $filterValue];
            } else {
                continue;
            }
        }

        $publicationQueryArray = new SearchController();
        $publications = [];
        $publicationQueryArray = $publicationQueryArray->search($searchQuery, [
            'publication' => $publicationModel,
        ]);
        $publicationQueryModel = $publicationQueryArray['model'] ?? $publicationQueryArray;
        switch ($filter) {
            case 1:
            case null:
                $publications = $publicationQueryModel
                    ->leftJoin('themes_and_publ', 'publications.id', '=', 'themes_and_publ.publ_id')
                    ->where($whereArray)
                    ->groupBy('id');
                break;
            case 2:
                $publications = $publicationQueryModel
                    ->leftJoin('themes_and_publ', 'publications.id', '=', 'themes_and_publ.publ_id')
                    ->where($whereArray)
                    ->orderBy($column, 'ASC')
                    ->groupBy('id');
                break;
            case 3:
                $publications = $publicationQueryModel
                    ->leftJoin('themes_and_publ', 'publications.id', '=', 'themes_and_publ.publ_id')
                    ->where($whereArray)
                    ->orderBy($column, 'DESC')
                    ->groupBy('id');
                break;
        }
        $publications = is_null($publicationQueryArray['query']) ?
            $publications->paginate(10, array('*'))              :
            $publications->paginate(10, array('*', $publicationQueryArray['query']));

        $publications->withPath(route('search') . '?education=' . $filters['education']
            . '&kind=' . $filters['kind']
            . '&theme=' . $filters['theme']
            . '&type=' . $filters['type']
            . '&searchQuery=' . $searchQuery);

        $educations = Education::all();
        $types = Type::all();
        $kinds = $filters['education'] == 0 ? Kind::all() : Kind::where('education_id', $filters['education'])->get();
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
                'filtersInfo' => $filtersInfo,
                'settingFilter' => $filters
            ]);
        } else {
            $publications->error = 'Нет публикаций удовлетворяющих критериям поиска';
            return view('publication/publications', [
                'publications' => $publications,
                'educations' => $educations,
                'kinds' => $kinds,
                'types' => $types,
                'themes' => $themes,
                'filtersInfo' => $filtersInfo,
                'settingFilter' => $filters
            ]);
        }
    }

    public function formationSnippetList($publications)
    {
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['user']['i'] = mb_substr($publication['user']['i'], 0, 1);
            $publication['user']['o'] = mb_substr($publication['user']['o'], 0, 1);
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
