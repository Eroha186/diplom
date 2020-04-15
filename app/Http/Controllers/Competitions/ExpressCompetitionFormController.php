<?php

namespace App\Http\Controllers\Competitions;

use App\Diplom;
use App\ExpressCompetition;
use App\ExpressWork;
use App\Http\Controllers\Auth\RandomPassword;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\TransactionController;
use App\Http\Requests\FormExpressCompetitionRequest;
use App\Repositories\CompetitionRepository;
use App\Repositories\DiplomRepository;
use App\Repositories\UserRepository;
use App\Repositories\Works\ExpressWorkRepository;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExpressCompetitionFormController extends Controller
{
    public function __construct()
    {
        $this->expressCompetitionRepository = new CompetitionRepository();
        $this->expressWorkRepository = new ExpressWorkRepository();
        $this->diplomRepository = new DiplomRepository();
        $this->userRepository = new UserRepository();
    }

    public function show(Request $request)
    {
        $id = $request->get('id');
        return view('express-competitions.form-competition', [
            'competitionSelected' => $this->expressCompetitionRepository->getExpressCompetition($id),
            'competitions' => $this->expressCompetitionRepository->getAllExpressCompetitions(),
            'user' => Auth::check()
                        ? $this->userRepository->getUserAuth()->toArray()
                        : [],
        ]);
    }

    public function saveExpressWork(FormExpressCompetitionRequest $request) {
        $data = $request->all();

        if (Auth::check()) {
            $data['user_id'] = Auth::user()->id;
        } else {
            $register = new RegisterController();
            $pass = RandomPassword::randomPassword();
            $request['password'] = $pass;
            $request['password_confirmation'] = $pass;
            $data['user_id'] = $register->registerFromPublicationForm($request)->id;
        }

        $work = $this->expressWorkRepository->createWork($data);

        if ($data['placement-method']) {
            if($data['uses-coins']) {
                (new TransactionController())->transferCoins([
                    'coins' => $data['coins'],
                    'user_id' => $work['user_id'],
                    'type' => 0,
                ]);
            }

            $diplom = $this->diplomRepository->create($work->id, 'expressCompetition');

            $post_data = [
                'userName' => $work['f'] . " " . $work['i'] . " " . $work['o'],
                'user_email' => $work['email'],
                'recipientAmount' => $work['cash'],
                'orderId' => $diplom->id,
            ];

            return view('payment', ['post_data' => $post_data]);
        }

        return redirect(route('home'));
    }

}
