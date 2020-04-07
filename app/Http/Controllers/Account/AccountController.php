<?php

namespace App\Http\Controllers\Account;

use App\Competition;
use App\ExpressWork;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Publication;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AccountController extends Controller
{

    public function showMyExpressCompetition(ExpressWork $workModel) {
        return view('account.my-express-competition', [
            'works' => $works,
            'data' => $user,
        ]);
    }
}