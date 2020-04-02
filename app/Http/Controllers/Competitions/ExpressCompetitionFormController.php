<?php

namespace App\Http\Controllers\Competitions;

use App\Competition_Nomination;
use App\Diplom;
use App\ExpressCompetition;
use App\ExpressWork;
use App\File;
use App\Http\Controllers\Auth\RandomPassword;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormExpressCompetitionRequest;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpressCompetitionFormController extends Controller
{
    public function show(Request $request)
    {
        $competitionSelected = $request->get('id');
        $competitions = ExpressCompetition::all();
        $nominations = Competition_Nomination::where('express_competition_id', $competitionSelected)
            ->leftJoin('nominations as n', 'nomination_id', '=', 'n.id')
            ->get();
        $user = [];
        if (Auth::check()) {
            $user = User::where('id', Auth::user()->id)->first()->toArray();
        }
        return view('express-competitions.form-competition', [
            'competitionSelected' => $competitionSelected,
            'competitions' => $competitions,
            'nominations' => $nominations,
            'user' => $user,
        ]);
    }

    public function saveExpressWork(FormExpressCompetitionRequest $request) {
        $work = $request->all();
        $placeArray = [1,2,2,3,3,3,4,4,4,4];
        if (Auth::check()) {
            $newWork = ExpressWork::create([
                'user_id' => Auth::user()->id,
                'competition_id' => (int) $work['competition'],
                'title' => $work['title'],
                'annotation' => $work['annotation'],
                'fc' => $work['fc'],
                'ic' => $work['ic'],
                'oc' => $work['oc'],
                'nomination_id' => (int) $work['nomination'],
                'date_add' => date('Y-m-d H:i:s', strtotime(now())),
                'age' => $work['age'],
                'place' => $placeArray[array_rand($placeArray, 1)],
            ]);
        } else {
            $register = new RegisterController();
            $pass = RandomPassword::randomPassword();
            $formRequest['password'] = $pass;
            $formRequest['password_confirmation'] = $pass;
            $newUser = $register->registerFromPublicationForm($formRequest);
            $newWork = ExpressWork::create([
                'user_id' => $newUser->id,
                'title' => $work['title'],
                'annotation' => $work['annotation'],
                'fc' => $work['fc'],
                'ic' => $work['ic'],
                'oc' => $work['oc'],
                'nomination_id' => (int) $work['nomination'],
                'date_add' => date('Y-m-d H:i:s', strtotime(now())),
                'age' => $work['age'],
                'place' => array_rand($placeArray, 1),
            ]);
        }
        if ($work['placement-method']) {
            $diplom = Diplom::create([
                'work_id' => $newWork->id,
                'type' => 'expressWork',
            ]);
            $post_data = [
                'userName' => $work['f'] . " " . $work['i'] . " " . $work['o'],
                'user_email' => $work['email'],
                'recipientAmount' => $work['cash'],
                'orderId' => $diplom->id,
            ];
            return view('payment', ['post_data' => $post_data]);
        } else {
            return redirect('/');
        }
    }

}
