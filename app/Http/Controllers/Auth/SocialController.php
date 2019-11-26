<?php

namespace App\Http\Controllers\Auth;

use App\SocialAccount;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    public function handleProviderCallback($provider)
    {
        $socialiteUser = Socialite::driver($provider)->user();
        $user = $this->findOrCreateUser($provider, $socialiteUser);
        auth()->login($user, true);
        return redirect(route('two-step-registration'));
    }

    public function findOrCreateUser($provider, $socialiteUser)
    {

        if ($user = $this->findUserBySocialId($provider, $socialiteUser->getId())) {
            return $user;
        }

        if ($user = $this->findUserByEmail($provider, $socialiteUser->getEmail())) {
            $this->addSocialAccount($provider, $user, $socialiteUser);

            return $user;
        }
        $password = RandomPassword::randomPassword();
        $name = explode(' ', $socialiteUser->getName());
        $user = User::create([
            'i' => $name[0],
            'f' => $name[1],
            'email' => $socialiteUser->getEmail(),
            'password' => password_hash($password, PASSWORD_DEFAULT),
        ]);

        $this->addSocialAccount($provider, $user, $socialiteUser);

        return $user;
    }

    public function findUserBySocialId($provider, $id)
    {
        $socialAccount = SocialAccount::where('provider', $provider)
            ->where('provider_id', $id)
            ->first();

        return $socialAccount ? $socialAccount->user : false;
    }

    public function findUserByEmail($provider, $email)
    {
        return !$email ? null : User::where('email', $email)->first();
    }

    public function addSocialAccount($provider, $user, $socialiteUser)
    {
        SocialAccount::create([
            'user_id' => $user->id,
            'provider' => $provider,
            'provider_id' => $socialiteUser->getId(),
            'token' => $socialiteUser->token,
        ]);
    }

    public function addEmailSocialUser(Request $request) {
        $verifyCreate = new RegisterController();
        Validator::make($request->all(), ['email' => 'required|email|unique:users'])->validate();
        User::where('id', Auth::user()->id)->update([
            'email' => $request->get('email')
        ]);
        $user = User::where('id', Auth::user()->id)->first();
//        dd($user);
        $verifyCreate->verifyCreate(['user' => $user]);
        return redirect(route('personal-data'));
    }
}
