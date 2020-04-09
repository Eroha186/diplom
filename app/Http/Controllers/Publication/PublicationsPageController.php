<?php

namespace App\Http\Controllers\Publication;

use App\Education;
use App\Http\Controllers\Controller;
use App\Kind;
use App\Publication;
use App\Repositories\PublicationRepository;
use App\Theme;
use App\Type;
use Illuminate\Support\Facades\Cookie;


class PublicationsPageController extends Controller
{

    public function __construct()
    {
        $this->publicationRepository = new PublicationRepository();
        $this->cash = config('payment_config.cash');
    }

    public function show()
    {
        $filter = Cookie::get('filter-p');
        $column = Cookie::get('column-p');

        if ($filter == 1 || is_null($filter)) {
            $publications = $this->publicationRepository->getAllConfirmedPublicationsOrderBy('date_add', 'DESC');
        } else {
            $publications = $this->publicationOrderAtBoot($filter, $column);
        }

        $filtersInfo = [
            'filter' => $filter,
            'column' => $column,
        ];

        $educations = Education::all();
        $types = Type::all();
        $kinds = Kind::all();
        $themes = Theme::all();

        return view('publication/publications', [
            'publications' => $publications,
            'educations' => $educations,
            'kinds' => $kinds,
            'types' => $types,
            'themes' => $themes,
            'filtersInfo' => $filtersInfo
        ]);
    }

    public function showPublication($id)
    {
        $publication = $this->publicationRepository->getPublication($id);

        return view('publication/publication', [
            'publication' => $publication,
        ]);
    }

    public function formationSnippetForkNewPublication($publicationModel)
    {

        $publications = $publicationModel::with($this->fields)->where('moderation', 2)->orderBy('date_add', 'desc')->limit(7)->get();
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['user']['i'] = mb_substr($publication['user']['i'], 0, 1);
            $publication['user']['o'] = mb_substr($publication['user']['o'], 0, 1);
            $publication['file'] = $publication['files'][0]['type'];
        }

        return $publications;
    }

    protected function publicationOrderAtBoot($filter, $column)
    {
        $publications = [];
        switch ($filter) {
            case 1:
                $publications = $this->publicationRepository->getAllConfirmedPublications();
                break;
            case 2:
                $publications = $this->publicationRepository->getAllConfirmedPublicationsOrderBy($column, 'DESC');
                break;
            case 3:
                $publications = $this->publicationRepository->getAllConfirmedPublicationsOrderBy($column, 'ASC');
                break;
        }
        return $publications;
    }
}
