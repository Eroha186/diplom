<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use App\Publication;
use App\User;
use App\Kind;
use App\Type;
use App\Education;
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
      $publication['author']['i'] = substr($publication['author']['i'], 0, 2);
      $publication['author']['o'] = substr($publication['author']['o'], 0, 2);
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

  }

  public function uploadFile()
  {

  }

}
