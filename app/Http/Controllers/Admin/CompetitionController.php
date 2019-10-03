<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormCreareCompetitionRequest;
use App\Type_competition;
use App\User;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{
    public function show()
    {
        $user = User::where('id', Auth::user()->id)->first();
        $typeCompetition = Type_competition::all();
        return view('admin/competitions', [
            'types' => $typeCompetition,
            'user' => $user,
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
