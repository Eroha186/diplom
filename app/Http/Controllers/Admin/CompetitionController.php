<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormCreareCompetitionRequest;
use App\Type_competition;
use App\User;
use App\Work;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{
    protected function user() {
        return User::where('id', Auth::user()->id)->first();
    }

    public function show()
    {
        $competitions = Competition::all();
        $typeCompetition = Type_competition::all();
        return view('admin/competitions', [
            'competitions' => $competitions,
            'types' => $typeCompetition,
            'user' => $this->user(),
        ]);
    }

    public function showCompetition($id) {
        $works = Work::select(['id', 'title'])->where([
            ['competition_id', $id],
            ['moderation', 0],
        ])->get();
//        dump($works);
        return view('admin/competition', [
            'idCompetition' => $id,
            'works' => $works,
            'user' => $this->user(),
        ]);
    }

    public function createCompetition(FormCreareCompetitionRequest $formRequest)
    {
        $data = $formRequest->all();
        $path = $formRequest->file('cover')->store('upload', 'public');
        Competition::create([
            'title' => $data['title'],
            'annotation' => $data['annotation'],
            'type_id' => (int)$data['type-competition'],
            'cover' => $path,
            'date_begin' => date('Y-m-d H:i:s', strtotime($data['date-begin'])),
            'date_end' => date('Y-m-d H:i:s', strtotime($data['date-end'])),
        ]);
        return redirect(route('a-competition'));
    }
}
