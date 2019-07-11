<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;

class PublicationsPageController extends Controller
{
  public function show(Publication $publicationModel) {

    $field = [
        'author',
        'type',
        'education',
        'kind'
    ];

    $publications = $publicationModel::with($field)->get();

    foreach ($publications as $publication) {
      $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
      $publication['author']['i'] = substr($publication['author']['i'],0,2);
      $publication['author']['o'] = substr($publication['author']['o'],0,2);
    }

    return view('publication/publication', ['publications' => $publications]);
  }

  public function showForm() {
    return view('publication/form-publication');
  }
}
