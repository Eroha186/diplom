<?php

namespace App\Http\Controllers\Competitions;

use App\Competition_Nomination;
use App\ExpressCompetition;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpressCompetitionFormController extends Controller
{
    public function show(Request $request) {
        $competitionSelected = $request->get('id');
        $competitions = ExpressCompetition::all();
        $nominations = Competition_Nomination::where('competition_id', $competitionSelected)
            ->leftJoin('nominations as n', 'nomination_id', '=', 'n.id')
            ->get();
        $user = [];
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first();
        }
        return view('competitions/form-competition', [
            'competitionSelected' => $competitionSelected,
            'competitions' => $competitions,
            'nominations' => $nominations,
            'user' => $user,
        ]);
    }
}
