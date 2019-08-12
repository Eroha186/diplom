<?php

namespace App\Http\Controllers\Publication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;

class PublicationSaveSession extends Controller
{
    public function publicationSaveSession(Request $request) {
        Session::put('publication', $request);
        return dump($request->post());
    }
}
