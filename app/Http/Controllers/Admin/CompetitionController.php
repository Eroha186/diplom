<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\ExpressCompetition;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormCreatCompetitionRequest;
use App\Type_competition;
use App\User;
use App\Work;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{
    protected function user()
    {
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

    public function showCompetition($id)
    {
        $works = Work::with(['file', 'user'])
                ->where([
                            ['competition_id', $id],
                            ['moderation', 0],
                        ])
                ->orWhere(function ($query) {
                            $query->where('moderation', 2);
                        })
                ->get();
        return view('admin/competition', [
            'idCompetition' => $id,
            'works' => $works,
            'user' => $this->user(),
        ]);
    }

    public function createCompetition(FormCreatCompetitionRequest $formRequest, $flag)
    {
        $data = $formRequest->all();
        $path = $formRequest->file('cover')->store('upload', 'public');
        if ($flag) {
            ExpressCompetition::create([
                'title' => $data['title'],
                'annotation' => $data['annotation'],
                'type_id' => (int)$data['type-competition'],
                'cover' => $path,
            ]);
        } else {
            Competition::create([
                'title' => $data['title'],
                'annotation' => $data['annotation'],
                'type_id' => (int)$data['type-competition'],
                'cover' => $path,
                'date_begin' => date('Y-m-d H:i:s', strtotime($data['date-begin'])),
                'date_end' => date('Y-m-d H:i:s', strtotime($data['date-end'])),
            ]);
        }
        return redirect(route('a-competition'));
    }
}
