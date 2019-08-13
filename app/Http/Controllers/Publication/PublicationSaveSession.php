<?php

namespace App\Http\Controllers\Publication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class PublicationSaveSession extends Controller
{
    public function publicationSaveSession(Request $request) {
        $requests = $request->all();
        foreach ($requests as $key => $value) {
            $request->session()->put($key,$value);
        }
    }
}
