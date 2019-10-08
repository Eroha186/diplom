<?php

namespace App\Http\Controllers\Competitions;

use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function show($id, $workId) {
        $work = Work::with(['user', 'file'])->where('id', $workId)->first();
        return view('competitions.work', [
            'work' => $work,
            'competitionId' => $id,
        ]);
    }
}
