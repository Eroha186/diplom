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

        $publicationModel = new Publication;
        $images = [];

        $newPublications = $this->formationSnippetForkNewPublication($publicationModel);
        $publication = $publicationModel::with($this->field)->where('id', $id)->first();
        $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
        foreach ($publication['files'] as $file) {
            if ($file['type'] == 'doc' || $file['type'] == 'pdf') {
                $publication['doc'] = $file['url'];
            }
            if ($file['type'] == 'ppt') {
                $publication['ppt'] = $file['url'];
            }
            if ($file['type'] == 'image') {
                $images[] = $file['url'];
            }
        }

        return view('publication/publication', [
            'publication' => $publication,
            'images' => $images,
            'newPublications' => $newPublications
        ]);
    }

    public function formationSnippetForkNewPublication($publicationModel)
    {

        $publications = $publicationModel::with($this->field)->where('moderation', 2)->orderBy('date_add', 'desc')->limit(7)->get();
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
