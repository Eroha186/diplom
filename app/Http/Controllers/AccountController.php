<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;

class AccountController extends Controller
{
  protected function validator(array $data)
  {
    return Validator::make($data, [
        'f' => 'required|string|max:30',
        'i' => 'required|string|max:30',
        'o' => 'required|string|max:30',
        'email' => 'required|email|max:60|unique:users',
        'password' => 'required|min:6|confirmed',
        'town' => 'required|string',
        'job' => 'required|string',
        'stuff' => 'required|string',
    ]);
  }


    public function showPersonalData() {

      $user = User::where('id',Auth::user()->id)->get();
     // dump($user);
      return view('account/personal-data', ['dat'=>$user]);
    }

    public function saveChangePersonalData(Request $request, array $data) {
      $this->validator($request->all())->validate();
      User::update(
          [
              'f' => $data['f'],
              'i' => $data['i'],
              'o' => $data['o'],
              'town' => $data['town'],
              'stuff' => $data['stuff'],
              'job' => $data['job'],
          ]
      );

    }

}
