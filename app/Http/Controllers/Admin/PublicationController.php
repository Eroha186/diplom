<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PublicationController extends Controller
{
    public function show(Request $request) {
        $user = User::where('id', Auth::user()->id)->first();
        return view('admin.main', [
            'user' => $user
        ]);
    }

    public function showAdmin(Request $request) {

    }
}
