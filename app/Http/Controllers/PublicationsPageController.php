<?php

namespace App\Http\Controllers;

use App\Theme;
use Illuminate\Http\Request;
use App\Publication;
use App\User;
use App\Kind;
use App\Type;
use  Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class PublicationsPageController extends Controller
{

  protected function validator(array $data)
  {

    $validate = [];

    if (Auth::check()) {
      $validate = [
          'kind' => 'required|min:0',
          'name-work' => 'required|string',
          'type' => 'required|min:0',
          'annatation' => 'required|string|max:100',
          'files.*' => '[file, required|mimes:jpg,png,doc,docx,pdf,ppt,pptx]',
          'offer' => 'accepted',
          'processing-pd' => 'accepted',
      ];
    } else {
      $validate = [
          'f' => 'required|string|max:30',
          'i' => 'required|string|max:30',
          'o' => 'required|string|max:30',
          'town' => 'required|string',
          'job' => 'required|string',
          'stuff' => 'required|string',
          'email' => 'required|email|max:60|unique:users',
          'kind' => 'required|min:0',
          'name-work' => 'required|string',
          'type' => 'required|min:0',
          'annatation' => 'required|string|max:100',
          'files.*' => 'required|mimes:jpg,png,doc,docx,pdf,ppt,pptx',
          'offer' => 'accepted',
          'processing-pd' => 'accepted',
      ];
    }


    return Validator::make($data, $validate);
  }

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
    if (Auth::check()) {
      $user = User::where('id', Auth::user()->id)->first();
      return view('publication/form-publication', [
          'user' => $user,
          'types' => $types,
          'kinds' => $kinds,
          'themes' => $themes
      ]);
    } else {
      return view('publication/form-publication', [
          'types' => $types,
          'kinds' => $kinds,
          'themes' => $themes
      ]);
    }

  }

  public function savePublication(Request $request)
  {
    $this->validator($request->all())->validate();
    $this->uploadFile();
  }

  public function uploadFile() {

  }

}
