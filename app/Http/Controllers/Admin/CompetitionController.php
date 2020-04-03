<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Competition_Nomination;
use App\ExpressCompetition;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormCreatCompetitionRequest;
use App\Nomination;
use App\Substrate;
use App\Type_competition;
use App\User;
use App\Work;
use Illuminate\Http\Request;
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
            'nominations' => Nomination::all(),
        ]);
    }

    public function showCompetition($id)
    {
        $works = Work::with(['file', 'user'])
            ->where([
                ['competition_id', $id],
                ['moderation', 0],
                ['place', 0]
            ])
            ->orWhere([
                ['moderation', 2], ['place', 0]
            ])
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
            $expressCompetition = ExpressCompetition::create([
                'title' => $data['title'],
                'annotation' => $data['annotation'],
                'type_id' => (int)$data['type-competition'],
                'cover' => $path,
                'substrate_id' => 0 + $data['substrate'],
            ]);
            foreach ($data['nominations'] as $nomination) {
                Competition_Nomination::insert([
                    'nomination_id' => $nomination,
                    'express_competition_id' => $expressCompetition->id
                ]);
            }
        } else {
            $competition = Competition::create([
                'title' => $data['title'],
                'annotation' => $data['annotation'],
                'type_id' => (int)$data['type-competition'],
                'cover' => $path,
                'date_begin' => date('Y-m-d H:i:s', strtotime($data['date-begin'])),
                'date_end' => date('Y-m-d H:i:s', strtotime($data['date-end'])),
                'substrate_id' => 0 + $data['substrate'],
            ]);
            foreach ($data['nominations'] as $nomination) {
                Competition_Nomination::insert([
                    'competition_id' => $competition->id,
                    'nomination_id' => $nomination,
                ]);
            }
        }
        if ($competition)
            return redirect(route('a-competition', ['id' => $competition->id]));
        else
            return redirect(route('a-competitions'));
    }

    public function changePlace($place, $id)
    {
        $work = Work::where('id', $id)->update([
            'place' => $place
        ]);
        return response()->json(['id' => $id]);
    }

    public function changeTypes(Request $request, $mode)
    {
        $types = $request->all();
        $types_old = [];
        switch ($mode) {
            case 'add':
                $types1 = Type_competition::all();
                foreach ($types1 as $type) {
                    $types_old[] = $type->name;
                }
                $types = preg_split('/\\r\\n?|\\n/', $types['data']);
                $types = array_unique($types);
                // удаляем пустые элементы массива, потом удалеям темы которые есть и в массиве и в БД
                $types = array_diff(array_diff($types, array('')), $types_old);
                foreach ($types as $type) {
                    Type_competition::create([
                        'name' => trim($type)
                    ]);
                }
                break;
            case 'del':
                Type_competition::where('id', $types['id'])->delete();
                break;
            case 'change':
                Type_competition::where('id', $types['id'])->update([
                    'name' => $types['val'],
                ]);
                break;
        }
        $types = Type_competition::all();
        return $types;
    }

}
