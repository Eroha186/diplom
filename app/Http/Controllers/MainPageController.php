<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Publication;
use Illuminate\Support\Facades\DB;
class MainPageController extends Controller
{
	public function show()
	{
		$data = 	DB::select('SELECT * FROM `publications` LEFT JOIN `users` ON publications.id_user = users.id');
//		echo '<pre>';
//		print_r($data);
//		echo '</pre>';
		return view('main', ['data' => $data]);
	}
}
