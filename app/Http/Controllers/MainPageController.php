<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
	public function show()
	{
    $data = Publication::find(1);
    dump($data);
		//return view('main', ['data' => $data]);
	}
}
