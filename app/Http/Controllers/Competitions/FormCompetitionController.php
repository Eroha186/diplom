<?php

namespace App\Http\Controllers\Competitions;

use App\Diplom;
use App\File;
use App\Http\Controllers\Auth\RandomPassword;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\UploadFileController;
use App\Http\Requests\FormCompetitionRequest;
use App\Repositories\CompetitionRepository;
use App\Repositories\DiplomRepository;
use App\Repositories\UserRepository;
use App\Repositories\Works\WorkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Competition;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Work;

class FormCompetitionController extends Controller
{
    public function __construct()
    {
        $this->cash = config('payment_config.cash');
        $this->competitionRepository = new CompetitionRepository();
        $this->userRepository = new UserRepository();
        $this->workRepository = new WorkRepository();
        $this->diplomRepository = new DiplomRepository();
    }

    public function show(Request $request)
    {
        $id = $request->get('id');

        if(Auth::check()) {
            $data = [
                'competitionSelected' => $this->competitionRepository->getCompetition($id),
                'competitions' => $this->competitionRepository->getAllRelevantCompetition(),
                'user' => $this->userRepository->getUserAuth(),
                'cash' => $this->cash,
            ];
        } else {
            $data = [
                'competitionSelected' => $this->competitionRepository->getCompetition($id),
                'competitions' => $this->competitionRepository->getAllRelevantCompetition(),
                'cash' => $this->cash,
            ];
        }

        return view('competitions/form-competition', $data);
    }

    public function saveWorkCompetition(FormCompetitionRequest $formRequest)
    {
        $data = $formRequest->all();
        if (Auth::check()) {
            $data['user_id'] = $this->userRepository->getUserAuth()->id;
        } else {
            $register = new RegisterController();
            $pass = RandomPassword::randomPassword();
            $formRequest['password'] = $pass;
            $formRequest['password_confirmation'] = $pass;
            $data['user_id'] = $register->registerFromPublicationForm($formRequest)->id;
        }

        $work = $this->workRepository->createWork($data);

        (new UploadFileController())->uploadFile($formRequest->file('file'), 'competition', $work->id);

        if ($formRequest['placement-method']) {
            if ($formRequest['uses-coins']) {
                (new TransactionController())->transferCoins([
                    'coins' => $formRequest['coins'],
                    'user_id' => $data['user_id'],
                    'type' => 0,
                ]);
            }

            $diplom = $this->diplomRepository->create($work->id, 'competition');

            $post_data = [
                'userName' => $data['f'] . " " . $data['i'] . " " . $data['o'],
                'user_email' => $data['email'],
                'recipientAmount' => $data['cash'],
                'orderId' => $diplom->id,
            ];

            return view('payment', ['post_data' => $post_data]);
        }

        return redirect('/');
    }

    public function ajaxLoadNomination($competition_id)
    {
        return Competition::with('nominations')->where('id', $competition_id)->get()->first();
    }

}
