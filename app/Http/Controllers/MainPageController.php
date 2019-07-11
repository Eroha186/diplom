<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use App\User;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
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
      $publication['author']['i'] = substr($publication['author']['i'],0,2);
      $publication['author']['o'] = substr($publication['author']['o'],0,2);
    }

    return view('main', ['publications' => $publications]);
  }
}
