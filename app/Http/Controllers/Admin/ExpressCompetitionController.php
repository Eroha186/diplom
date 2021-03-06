<?php

namespace App\Http\Controllers\Admin;

use App\Nomination;
use App\Substrate;
use App\Type_competition;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ExpressCompetitionController extends Controller
{
    use AdminController;

    public function show() {
        return view('admin/express-competitions', [
            'types' => Type_competition::all(),
            'user' => $this->user(),
            'substrates' => Substrate::all(),
            'nominations' => Nomination::all(),
        ]);
    }
}
