<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{
  protected function validator(array $data)
  {
    return Validator::make($data, [
        'f' => 'required|string|max:30',
        'i' => 'required|string|max:30',
        'o' => 'required|string|max:30',
        'email' => 'required|email|max:60|unique:users',
        'town' => 'required|string',
        'job' => 'required|string',
        'stuff' => 'required|string',
    ]);
  }


  public function showPersonalData()
  {

    $user = User::where('id', Auth::user()->id)->get();

    return view('account/personal-data', ['dat' => $user]);
  }

  public function saveChangePersonalData(Request $request)
  {
    $this->validator($request->all())->validate();
    return $this->userUpdate($request->all());
  }

  protected function userUpdate(array $data)
  {
    $info = [
        'f' => $data['f'],
        'i' => $data['i'],
        'o' => $data['o'],
        'town' => $data['town'],
        'stuff' => $data['stuff'],
        'job' => $data['job'],
    ];
    if (isset($data['email'])) {
      $info['email'] = $data['email'];
      $info['confirm'] = 0;
      User::where('id', Auth::user()->id)->update($info);
    } else {
      User::where('id', Auth::user()->id)->update($info);
    }
    return $this->showPersonalData();
  }

}
