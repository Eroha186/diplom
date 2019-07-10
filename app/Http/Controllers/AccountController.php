<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Auth\RegisterController;

class AccountController extends Controller
{
  protected function validator(array $data)
  {
    $validate = [
        'f' => 'required|string|max:30',
        'i' => 'required|string|max:30',
        'o' => 'required|string|max:30',
        'town' => 'required|string',
        'job' => 'required|string',
        'stuff' => 'required|string',
    ];
    if($data['email'] !== Auth::user()->email) {
      $validate['email'] = 'required|email|max:60|unique:users';
    }

    return Validator::make($data, $validate);
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
    $user = User::where('email',$data['email'])->first();
    $info = [
        'f' => $data['f'],
        'i' => $data['i'],
        'o' => $data['o'],
        'town' => $data['town'],
        'stuff' => $data['stuff'],
        'job' => $data['job'],
    ];
    if ($data['email'] !== $user['email']) {
      $info['email'] = $data['email'];
      $info['confirm'] = 0;
      User::where('id', Auth::user()->id)->update($info);
      $user = User::where('id', Auth::user()->id)->first();
      $verify = new RegisterController();
      $verify->verifyCreate($user);
      $this->guard()->logout();
      return redirect('/login')->with('status', 'Мы отправили вам код активации. Проверьте свою электронную почту и нажмите на ссылку, чтобы подтвердить.');
    } else {
      User::where('id', Auth::user()->id)->update($info);
      return $this->showPersonalData();
    }
  }

  protected function guard()
  {
    return Auth::guard();
  }

}