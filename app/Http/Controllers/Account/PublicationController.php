<?php

namespace App\Http\Controllers\Account;

use App\Publication;
use App\Repositories\PublicationRepository;
use App\Repositories\UserRepository;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function __construct()
    {
        $this->userRepository = new UserRepository();
        $this->publicationRepository = new PublicationRepository();
    }

    public function show()
    {
        return view('account.my-publication', [
            'publications' => $this->publicationRepository->getAllPublicationUser(),
            'data' => $this->userRepository->getUserAuth()
        ]);
    }
}
