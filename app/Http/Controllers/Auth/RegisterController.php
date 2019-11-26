<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Mail\VerifyMail;
use App\User;
use App\VerifyUser;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

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

    public function register(Request $request)
    {
        $this->validator($request->all())->validate();

        event(new Registered($user = $this->create($request->all())));

        return redirect()->route('login')
            ->with('status', 'Потвердите ваш e-mail.');
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\User
     */
    public function create(array $data)
    {
        $user = User::create([
            'f' => $data['f'],
            'i' => $data['i'],
            'o' => $data['o'],
            'email' => $data['email'],
            'stuff' => $data['stuff'],
            'town' => $data['town'],
            'job' => $data['job'],
            'date_reg' => date('Y-m-d H:i:s'),
            'password' => password_hash($data['password'], PASSWORD_DEFAULT),
        ]);
        $userInfoForMail = array(
            'user' => $user,
            'password' => $data['password'],
        );
        $this->verifyCreate($userInfoForMail);
        return $user;
    }

    public function verifyCreate($user)
    {
        $user = (object)$user;
        $verifyUser = VerifyUser::create([
            'user_id' => $user->user->id,
            'token' => str_random(40)
        ]);

        Mail::to($user->user->email)->send(new VerifyMail($user));

    }

    public function verifyUser($token)
    {
        $verifyUser = VerifyUser::where('token', $token)->first();
        if (isset($verifyUser)) {
            $user = $verifyUser->user;
            if (!$user->confirm) {
                $verifyUser->user->confirm = 1;
                $verifyUser->user->save();
                $status = "Ваш адрес электронной почты подтвержден. Теперь вы можете войти.";
                $verifyUser->where('user_id', $verifyUser->user_id)->delete();
            } else {
                $status = "Ваша электронная почта уже проверена. Теперь вы можете войти.";
            }
        } else {
            return redirect('/login')->with('error', "Извините, ваш адрес электронной почты не может быть идентифицирован.");
        }
        return redirect('/login')->with('status', $status);
    }


    public function registerFromPublicationForm(Request $request)
    {
        $data = $request->all();
        $user =  User::where('email', $data['email'])->first();
        $userStatus = $this->existenceUser($user);
        switch ($userStatus) {
            case 0:
                $this->validator($request->all())->validate();
                event(new Registered($user = $this->create($request->all())));

                return $user;
                break;
            case 1:
                $userInfoForMail = array(
                    'user' => $user,
                    'password' => $data['password'],
                );
                $this->verifyCreate($userInfoForMail);
                User::where('email', $data['email'])->update(['password' => password_hash($data['password'], PASSWORD_DEFAULT)]);
                return $user;
                break;
            case 2:
                return $user;
                break;
        }
    }

    public function existenceUser($user) {
        if(count($user) > 0) {
            if($user->confirm) {
                return 2; // confirm
            } else {
                return 1; // not confirm
            }
        } else {
            return 0; //not exist
        }
    }
}
