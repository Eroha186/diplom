<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\DB;

class MainPageController extends Controller
{
	public function show()
	{
    $data = Publication::all()->get();
		return view('main', ['data' => $data]);
	}
}
