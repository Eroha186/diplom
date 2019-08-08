<?php

namespace App\Http\Controllers;

use App\Publication;


class MainPageController extends Controller
{
    public function show(Publication $publicationModel)
    {

        $field = [
            'author',
            'type',
            'education',
            'kind',
            'files',
        ];

        $publications = $publicationModel::with($field)->limit(12)->get();

        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['author']['i'] = mb_substr($publication['author']['i'], 0, 1);
            $publication['author']['o'] = mb_substr($publication['author']['o'], 0, 1);
            $publication['file'] = $publication['files'][0]['type'];
        }

        return view('main', ['publications' => $publications]);
    }
}
