<?php

namespace App\Http\Controllers;

use App\Publication;

class FilterPublicationController extends Controller
{
    protected $field = [
        'author',
        'type',
        'education',
        'theme',
        'kind',
        'files'
    ];

    public function order($column,$filter)
    {

        $publicationModel = new Publication();
        $publications = [];
        switch ($filter) {
            case 1:
                $publications = $publicationModel::with($this->field)->get();
                break;
            case 2:
                $publications = $publicationModel::with($this->field)->orderBy($column, 'DESC')->get();
                break;
            case 3:
                $publications = $publicationModel::with($this->field)->orderBy($column, 'ASC')->get();
                break;
        }

        return response()->json($this->formationSnippet($publications), 200);
    }

    public function search($request) {
        $publicationModel = new Publication();
        $publications = $publicationModel::with($this->field)->where('title','LIKE', '%'.$request.'%')->get();
        if($publications) {
            return response()->json(['error' => 'Нет записей подходящих условию поиска', 'status' => false]);
        } else {
            return response()->json($this->formationSnippet($publications), 200);
        }
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
