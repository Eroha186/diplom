<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\ExpressCompetition;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormCreatCompetitionRequest;
use App\Substrate;
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
        return view('admin/competitions', [
            'competitions' => Competition::all(),
            'types' => Type_competition::all(),
            'user' => $this->user(),
            'substrates' => Substrate::all(),
        ]);
    }

    public function showCompetition($id)
    {
        $works = Work::with(['file', 'user'])
                ->where([
                            ['competition_id', $id],
                            ['moderation', 0],
                            ['place', 0 ]
                        ])
                ->orWhere(function ($query) {
                            $query->where([
                                ['moderation', 2], ['place', 0 ]
                            ]);
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
        $competition = 0;
        if ($flag) {
            ExpressCompetition::create([
                'title' => $data['title'],
                'annotation' => $data['annotation'],
                'type_id' => (int)$data['type-competition'],
                'cover' => $path,
                'substrate_id' => 0 + $data['substrate'],
            ]);
        } else {
            dump($data['substrate'] + 0);
            $competition = Competition::create([
                'title' => $data['title'],
                'annotation' => $data['annotation'],
                'type_id' => (int)$data['type-competition'],
                'cover' => $path,
                'date_begin' => date('Y-m-d H:i:s', strtotime($data['date-begin'])),
                'date_end' => date('Y-m-d H:i:s', strtotime($data['date-end'])),
                'substrate_id' => 0 + $data['substrate'],
            ]);
        }
        if($competition)
            return redirect(route('a-competition', ['id' => $competition]));
        else
            return redirect(route('a-competitions'));
    }

    public function changePlace($place, $id) {
        $work = Work::where('id', $id)->update([
            'place' => $place
        ]);
        return response()->json(['id' => $id]);
    }
}
