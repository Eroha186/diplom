<?php

namespace App\Http\Controllers\Admin;

use App\Type_competition;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpressCompetitionController extends Controller
{
    public function show() {
        $typeCompetition = Type_competition::all();
        return view('admin/express-competitions', [
            'types' => $typeCompetition,
            'user' => User::where('id', Auth::user()->id)->first(),
        ]);
    }
}
