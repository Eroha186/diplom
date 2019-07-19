<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use App\Publication;
use App\User;
use App\Kind;
use App\Type;
use App\Education;
use App\File;
use App\Http\Requests\FormPublicationRequest;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PublicationsPageController extends Controller
{

    public function show(Publication $publicationModel)
    {

        $field = [
            'author',
            'type',
            'education',
            'kind'
        ];

        $publications = $publicationModel::with($field)->get();

        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['author']['i'] = mb_substr($publication['author']['i'], 0, 1);
            $publication['author']['o'] = mb_substr($publication['author']['o'], 0, 1);
        }

        return view('publication/publication', ['publications' => $publications]);
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

}
