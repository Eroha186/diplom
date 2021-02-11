<?php

namespace App\Http\Controllers;

use App\Competition;
use App\Publication;


class MainPageController extends Controller
{
    public function show(Publication $publicationModel, Competition $competitionModel)
    {

        $field = [
            'user',
            'type',
            'education',
            'kind',
            'files',
        ];

        $publications = $publicationModel::with($field)->limit(12)->orderbyDesc('date_add')->get();

        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['user']['i'] = mb_substr($publication['user']['i'], 0, 1);
            $publication['user']['o'] = mb_substr($publication['user']['o'], 0, 1);
            if(isset($publication['files'][0]['type']))
                $publication['file'] = $publication['files'][0]['type'];
        }

        $competitions = $competitionModel->where('date_end', '>',  date('Y-m-d H:i:s', time()))->limit(8)->get();
        foreach ($competitions as $competition) {
            $competition['date_begin'] = date("d.m.Y", strtotime($competition['date_begin']));
            $competition['date_end'] = date("d.m.Y", strtotime($competition['date_end']));
        }
        return view('main', [
            'publications' => $publications,
            'competitions' => $competitions,
        ]);
    }


}
