<?php

namespace App\Http\Controllers\Account;

use App\Repositories\UserRepository;
use App\Repositories\Works\WorkRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CompetitionController extends Controller
{
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->workRepository = new WorkRepository();
    }

    public function show()
    {
        return view('account.part-contests', [
            'works' => $this->workRepository->getWorkUser(),
            'data' => $this->userRepository->getUserAuth(),
        ]);
    }
}
