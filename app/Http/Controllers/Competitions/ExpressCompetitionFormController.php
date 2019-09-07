<?php

namespace App\Http\Controllers\Competitions;

use App\Competition_Nomination;
use App\ExpressCompetition;
use App\ExpressWork;
use App\File;
use App\Http\Controllers\Auth\RandomPassword;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormExpressCompetitionRequest;
use App\User;
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
            $user = User::where('id', Auth::user()->id)->first();
        }
        return view('competitions/form-competition', [
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
                'date_add' => date('Y-m-d H:i:s'),
                'age' => $work['age'],
                'place' => array_rand($placeArray, 1),
            ]);
        } else {
            $register = new RegisterController();
            $pass = RandomPassword::randomPassword();
            $formRequest['password'] = $pass;
            $formRequest['password_confirmation'] = $pass;
            $newUser = $register->registerFromPublicationForm($formRequest);
            $newWork = Work::create([
                'user_id' => $newUser->id,
                'title' => $work['title'],
                'annotation' => $work['annotation'],
                'fc' => $work['fc'],
                'ic' => $work['ic'],
                'oc' => $work['oc'],
                'nomination_id' => (int) $work['nomination'],
                'date_add' => date('Y-m-d H:i:s'),
                'age' => $work['age'],
                'place' => array_rand($placeArray, 1),
            ]);
        }
        $this->uploadFile($request->file('file'), $newWork->id);

    }

    public function uploadFile($file, $work_id)
    {
        $type = $file->getMimeType();
        switch ($type) {
            case ('application/pdf'):
                $type = 'pdf';
                break;
            case ('image/jpeg'):
            case ('image/png'):
                $type = 'image';
                break;
            case ('application/vnd.openxmlformats-officedocument.wordprocessingml.document'):
            case ('application/msword'):
                $type = 'doc';
                break;
            case ('application/vnd.openxmlformats-officedocument.presentationml.presentation'):
            case ('application/vnd.ms-powerpoint'):
                $type = 'ppt';
                break;
        }
        $path = $file->store('upload', 'public');
        File::create([
            'publ_id' => 0,
            'url' => $path,
            'type' => $type,
            'work_id' => 0,
            'express_work_id' => $work_id
        ]);
    }
}
