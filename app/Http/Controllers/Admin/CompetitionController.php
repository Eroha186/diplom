<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{
    public function show() {
        $user = User::where('id', Auth::user()->id)->first();
        return view('admin/competitions', [
            'user' => $user,
        ]);
    }
}
