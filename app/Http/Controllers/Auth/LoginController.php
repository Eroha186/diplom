<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
//    protected $redirectTo = 'account/personal-data';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function authenticated(Request $request, $user)
    {
        if ($user->confirm !== '1') {
            $this->guard()->logout();
            return back()->with('error', 'Вам необходимо подтвердить свой аккаунт. Пожалуйста, проверьте свою электронную почту.');
        }
        if ($request->path() == 'login') {
            return redirect()->to('/');
        }
        if ($request->path() == 'loginFormPublication') {
            return redirect()->to('form-publication');
        }
        if ($request->path() == 'loginFormCompetition') {
            return redirect()->to('form-competition');
        }
    }

    protected function sendLoginResponse(Request $request)
    {
        $request->session()->regenerate();

        $this->clearLoginAttempts($request);

        if ($request->path() == 'login') {
            return $this->authenticated($request, $this->guard()->user())
                ?: redirect()->to('account/personal-data');
        }
        if ($request->path() == 'loginFormPublication') ;
        {
            return $this->authenticated($request, $this->guard()->user())
                ?: back(200);
        }
    }

}
