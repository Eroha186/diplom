<?php

namespace App\Http\Controllers;

use App\HistoryUnsubscribe;
use App\Repositories\HistoryUnsubscribeRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    private $repositoryHistory;

    public function __construct()
    {
        $this->repositoryHistory = new HistoryUnsubscribeRepository();
    }

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
            $this->repositoryHistory->create($user->id, 1);
            return redirect('/');
        } else {
            return view('unsubscribe_error');
        }
    }
}
