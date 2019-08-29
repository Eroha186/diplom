<?php

namespace App\Http\Controllers\Competitions;

use App\Competition_Nomination;
use App\File;
use App\Http\Controllers\Auth\RandomPassword;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Requests\FormCompetitionRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Competition;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Work;

class FormCompetitionController extends Controller
{
    public function show(Request $request)
    {
        $competitionSelected = $request->get('id');
        $competitions = Competition::all();
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

    public function saveWorkCompetition(FormCompetitionRequest $formRequest)
    {
        $work = $formRequest->all();
        if (Auth::check()) {
            $newWork = Work::create([
                'user_id' => Auth::user()->id,
                'competition_id' => (int) $work['competition'],
                'title' => $work['title'],
                'annotation' => $work['annotation'],
                'fc' => $work['fc'],
                'ic' => $work['ic'],
                'oc' => $work['oc'],
                'nomination_id' => (int) $work['nomination'],
                'date_add' => date('Y-m-d H:i:s'),
            ]);
        } else {
            $register = new RegisterController();
            $work = $formRequest->all();
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
            ]);
        }
        $this->uploadFile($formRequest->file('file'), $newWork->id);
        return redirect('/');
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
            'work_id' => $work_id,
        ]);
    }
}
