<?php

namespace App\Http\Controllers\Account;

use App\Repositories\UserRepository;
use App\Repositories\Works\ExpressWorkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ExpressCompetitionController extends Controller
{
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->workRepository = new ExpressWorkRepository();
    }

    public function show()
    {
        return view('account.my-express-competition', [
            'works' => $this->workRepository->getWorkUser(),
            'data' => $this->userRepository->getUserAuth(),
        ]);
    }
}
