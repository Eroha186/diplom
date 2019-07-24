<?php

namespace App\Http\Controllers;

use App\Education;
use App\File;
use App\Http\Requests\FormPublicationRequest;
use App\Kind;
use App\Publication;
use App\Theme;
use App\ThemesAndPubl;
use App\Type;
use App\User;
use Illuminate\Support\Facades\Auth;

class PublicationsPageController extends Controller
{

    public function show(Publication $publicationModel)
    {

        $field = [
            'author',
            'type',
            'education',
            'theme',
            'kind',
            'files'
        ];

        $publications = $publicationModel::with($field)->get();
        $educations = Education::all();
        $types = Type::all();
        $kinds = Kind::all();
        $themes = Theme::all();

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
        return view('publication/publications', [
            'publications' => $publications,
            'educations' => $educations,
            'kinds' => $kinds,
            'types' => $types,
            'themes' => $themes,
        ]);
    }

    public function showForm()
    {
        $types = Type::all();
        $kinds = Kind::all();
        $themes = Theme::all();
        $educations = Education::all();
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
            return view('publication/form-publication', [
                'user' => $user,
                'types' => $types,
                'kinds' => $kinds,
                'themes' => $themes,
                'educations' => $educations,
            ]);
        } else {
            return view('publication/form-publication', [
                'types' => $types,
                'kinds' => $kinds,
                'themes' => $themes,
                'educations' => $educations,
            ]);
        }

    }

    public function savePublication(FormPublicationRequest $formRequest)
    {
        $newPublication = [];
        if (Auth::check()) {
            $data = $formRequest->all();
            $newPublication = Publication::create([
                'user_id' => Auth::user()->id,
                'title' => $data['title'],
                'annotation' => $data['annotation'],
                'type_id' => $data['type'],
                'kind_id' => $data['kind'],
                'education_id' => $data['education'],
                'text' => $data['text'],
                'moderation' => 0,
                'date_add' => date('Y-m-d H:i:s'),
            ]);
            foreach ($data['themes'] as $theme) {
                ThemesAndPubl::create([
                    'publ_id' => $newPublication->id,
                    'theme_id' => $theme,
                ]);
            }

        }
        $this->uploadFile($formRequest->file('files'), $newPublication->id);
        return redirect('/');
    }

    public function uploadFile(array $files, $publ_id)
    {
        foreach ($files as $file) {
            $type = $file->getMimeType();
            switch ($type) {
                case ('application/pdf'):
                    $type = 'pdf';
                    break;
                case ('image/jpeg'):
                case ('image/png'):
                    $type = 'image';
                    break;
                case ('application/vnd.openxmlformats-officedocument.wordprocessingml.document'):
                case ('application/msword'):
                    $type = 'doc';
                    break;
                case ('application/vnd.openxmlformats-officedocument.presentationml.presentation'):
                case ('application/vnd.ms-powerpoint'):
                    $type = 'ppt';
                    break;
            }
            $path = $file->store('upload', 'public');
            File::create([
                'publ_id' => $publ_id,
                'url' => $path,
                'type' => $type,
            ]);
        }
    }

    public function showPublication($id)
    {
        $field = [
            'author',
            'type',
            'education',
            'theme',
            'kind',
            'files'
        ];
        $publicationModel = new Publication;
        $images = [];

        $newPublications = $this->formationSnippetForkNewPublication($publicationModel);
        $publication = $publicationModel::with($field)->where('id', $id)->first();
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

        $field = [
            'author',
            'type',
            'education',
            'kind',
            'files',
        ];
        $date = new \DateTime('-6 hours');
        $date = $date->format('Y-m-d H:i:s');

        $publications = $publicationModel::with($field)->orderBy('date_add', 'desc')->limit(7)->get();
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['author']['i'] = mb_substr($publication['author']['i'], 0, 1);
            $publication['author']['o'] = mb_substr($publication['author']['o'], 0, 1);
            $publication['file'] = $publication['files'][0]['type'];
        }

        return $publications;
    }
}
