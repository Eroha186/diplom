<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublicationController extends Controller
{
    public function show(Request $request) {

    }

    public function showAdmin(Request $request) {
        return view('admin.main');
    }
}
