<?php

namespace App\Http\Controllers\Admin;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MailingController extends Controller
{

    protected function user()
    {
        return User::where('id', Auth::user()->id)->first();
    }

    public function show() {
        return view('admin.mailing', [
            'user' => $this->user(),
        ]);
    }
}
