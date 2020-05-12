<?php


namespace App\Repositories;


use App\User;
use Illuminate\Support\Facades\Auth;

class UserRepository
{

    public function getUserAuth()
    {
        return User::where('id', Auth::user()->id)->first();
    }

    public function updatePersonalDataWithChangeEmail($data)
    {
        return User::where('id', Auth::user()->id)->update([
            'f' => $data['f'],
            'i' => $data['i'],
            'o' => $data['o'],
            'email' => $data['email'],
            'confirm' => 0,
            'town' => $data['town'],
            'stuff' => $data['stuff'],
            'job' => $data['job'],
        ]);
    }

    public function updatePersonalDataWithoutChangingEmail($data)
    {
        return User::where('id', Auth::user()->id)->update([
            'f' => $data['f'],
            'i' => $data['i'],
            'o' => $data['o'],
            'town' => $data['town'],
            'stuff' => $data['stuff'],
            'job' => $data['job'],
        ]);
    }

    public function updateCoinsAuthUser($coins)
    {
        return User::where('id', Auth::user()->id)->update(['coins' => $coins]);
    }

    public function subscribeMailing($id)
    {
        return User::where('id', $id)->update([
            'mailing' => 1,
        ]);
    }

    public function cancelMailing($id)
    {
        return User::where('id', $id)->update([
            'mailing' => 0,
        ]);
    }
}