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
    protected $field = [
        'user',
        'diplom',
        'type',
        'education',
        'kind',
        'files',
    ];

    protected function validator(array $data)
    {
        $validate = [
            'f' => 'required|string|max:30',
            'i' => 'required|string|max:30',
            'o' => 'required|string|max:30',
            'town' => 'required|string',
            'job' => 'required|string',
            'stuff' => 'required|string',
        ];
        if ($data['email'] !== Auth::user()->email) {
            $validate['email'] = 'required|email|max:60|unique:users';
        }

        return Validator::make($data, $validate);
    }

    public function showPersonalData()
    {

        $user = User::where('id', Auth::user()->id)->first();
        return view('account/personal-data', ['data' => $user]);
    }

    public function saveChangePersonalData(Request $request)
    {
        $this->validator($request->all())->validate();
        return $this->userUpdate($request->all());
    }

    protected function userUpdate(array $data)
    {
        $user = User::where('email', $data['email'])->first();
        $info = [
            'f' => $data['f'],
            'i' => $data['i'],
            'o' => $data['o'],
            'town' => $data['town'],
            'stuff' => $data['stuff'],
            'job' => $data['job'],
        ];
        if ($data['email'] !== $user['email']) {
            $info['email'] = $data['email'];
            $info['confirm'] = 0;
            User::where('id', Auth::user()->id)->update($info);
            $user = User::where('id', Auth::user()->id)->first();
            $verify = new RegisterController();
            $verify->verifyCreate($user);
            $this->guard()->logout();
            return redirect('/login')->with('status', 'Мы отправили вам код активации. Проверьте свою электронную почту и нажмите на ссылку, чтобы подтвердить.');
        } else {
            User::where('id', Auth::user()->id)->update($info);
            return $this->showPersonalData();
        }
    }

    protected function guard()
    {
        return Auth::guard();
    }

    public function showMyPublication(Publication $publicationModel)
    {
        $publications = $publicationModel->with($this->field)->where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['user']['i'] = mb_substr($publication['user']['i'], 0, 1);
            $publication['user']['o'] = mb_substr($publication['user']['o'], 0, 1);
        }

        return view('account.my-publication', ['publications' => $publications, 'data' => $user]);
    }

    public function showPartInContests(Work $workModel)
    {
        $works = $workModel->with(['competition', 'user', 'diplom'])->where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        foreach ($works as $work) {
            $work['date_add'] = date("d.m.Y", strtotime($work['date_add']));
            $work['user']['i'] = mb_substr($work['user']['i'], 0, 1);
            $work['user']['o'] = mb_substr($work['user']['o'], 0, 1);
            $work['ic'] = mb_substr($work['ic'], 0, 1);
            $work['oc'] = mb_substr($work['oc'], 0, 1);
        }
        return view('account.part-contests', [
            'works' => (object)$works,
            'data' => (object)$user,
        ]);
    }

    public function showMyExpressCompetition(ExpressWork $workModel) {
        $works = $workModel->with(['competition', 'user', 'diplom'])->where('user_id', Auth::user()->id)->get();
        $user = User::where('id', Auth::user()->id)->first();
        foreach ($works as $work) {
            $work['date_add'] = date("d.m.Y", strtotime($work['date_add']));
            $work['user']['i'] = mb_substr($work['user']['i'], 0, 1);
            $work['user']['o'] = mb_substr($work['user']['o'], 0, 1);
            $work['ic'] = mb_substr($work['ic'], 0, 1);
            $work['oc'] = mb_substr($work['oc'], 0, 1);
        }
        return view('account.my-express-competition', [
            'works' => $works,
            'data' => $user,
        ]);
    }
}