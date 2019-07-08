<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use http\Env\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;

class RegisterController extends Controller
{
  /*
  |--------------------------------------------------------------------------
  | Register Controller
  |--------------------------------------------------------------------------
  |
  | This controller handles the registration of new users as well as their
  | validation and creation. By default this controller uses a trait to
  | provide this functionality without requiring any additional code.
  |
  */

  use RegistersUsers;

  /**
   * Where to redirect users after registration.
   *
   * @var string
   */
  protected $redirectTo = '/account/personal-data';

  /**
   * Create a new controller instance.
   *
   * @return void
   */
  public function __construct()
  {
    $this->middleware('guest');
  }

  /**
   * Get a validator for an incoming registration request.
   *
   * @param array $data
   * @return \Illuminate\Contracts\Validation\Validator
   */
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

  /**
   * Create a new user instance after a valid registration.
   *
   * @param array $data
   * @return \App\User
   */
  protected function create(array $data)
  {
    return User::create([
        'f' => $data['f'],
        'i' => $data['i'],
        'o' => $data['o'],
        'email' => $data['email'],
        'stuff' => $data['stuff'],
        'town' => $data['town'],
        'job' => $data['job'],
        'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        'date_reg' => date('Y-m-d H:i:s')
    ]);
  }

  public function getRegister()
  {
    return view('auth/register');
  }

  public function postRegister(Request $request)
  {
    $validator = $this->validator($request->all());
    if ($validator->fails()) {
      throwValidationException($request, $validator);
    };
    $user = $this->create($request->all());
  }

}
