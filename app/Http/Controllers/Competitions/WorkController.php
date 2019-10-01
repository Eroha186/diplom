<?php

namespace App\Http\Controllers\Competitions;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function show($id, $workId) {
        
        return view('competitions.work');
    }
}
