<?php

namespace App\Http\Controllers\Admin;

use App\Substrate;
use App\Type_competition;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpressCompetitionController extends Controller
{
    public function show() {
        return view('admin/express-competitions', [
            'types' => Type_competition::all(),
            'user' => User::where('id', Auth::user()->id)->first(),
            'substrates' => Substrate::all(),
        ]);
    }
}
