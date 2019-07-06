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
    return view('main', ['publications' => $publications]);
  }
}
