<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
	public function show(Publication $publicationsModel)
	{
    $fieldPublication = [
        'educations.name as education',
        'kinds.name as kind',
        'publications.title',
        'publications.annatation',
        'publications.text',
        'publications.moderation',
        'publications.date_add',
        'types.name as type',
        'users.f',
        'users.i',
        'users.o',
        'users.stuff',

    ];

	  $publications = $publicationsModel->getPublications($fieldPublication) ;
	  dump($publications);
		return view('main', ['publications' => $publications]);

	}
}
