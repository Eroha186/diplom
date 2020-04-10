<?php

namespace App\Http\Controllers\Competitions;

use App\Repositories\Works\WorkRepository;
use App\Work;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class WorkController extends Controller
{
    public function __construct()
    {
        $this->workRepository = new WorkRepository();
    }

    public function show($id, $workId) {
        return view('competitions.work', [
            'work' => $this->workRepository->getWork($workId),
            'competitionId' => $id,
        ]);
    }
}
