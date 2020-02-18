<?php

namespace App\Http\Controllers;

use App\Diplom;
use App\Education;
use App\Mail\ExpressCompetitionDiplom;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class Test extends Controller
{
    public function test() {
        $mial = Mail::to("admin@mail.ru")->send(new \App\Mail\Test());
        dd($mial);
    }

}
