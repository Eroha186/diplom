<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function unsubscribe(Request $request)
    {
        $hash = $request->get('hash');

        $user = User::where('hash', $hash)->first();

        if($user !== null ) {
            return view('unsubscribe', [
                'name' => $user->i,
                'email' => $user->email,
                'hash' => $hash,
            ]);
        }
    }

    public function unsubscribeApproved(Request $request)
    {
        $hash = $request->get('hash');

        $user = User::where('hash', $hash)->first();

        if($user !== null ) {
            $user->mailing = 0;
            $user->save();
            return redirect('/');
        } else {
            return view('unsubscribe_error');
        }
    }
}
