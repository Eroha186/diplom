<?php

namespace App\Http\Controllers\Admin;

use App\Competition;
use App\ExpressCompetition;
use App\Http\Controllers\Controller;
use App\Http\Requests\FormCreatCompetitionRequest;
use App\Nomination;
use App\Repositories\CompetitionRepository;
use App\Repositories\Works\WorkRepository;
use App\Substrate;
use App\Type_competition;
use App\User;
use App\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CompetitionController extends Controller
{
    use AdminController;

    public function __construct()
    {
        $this->competitionRepository = new CompetitionRepository();
        $this->workRepository = new WorkRepository();
    }

    public function show()
    {
        return view('admin/competitions', [
            'competitions' => $this->competitionRepository->getAllCompetition(),
            'types' => Type_competition::all(),
            'user' => $this->user(),
            'substrates' => Substrate::all(),
            'nominations' => Nomination::all(),
        ]);
    }

    public function showCompetition($id)
    {
        return view('admin/competition', [
            'idCompetition' => $id,
            'worksForModeration' => $this->workRepository->getWorksForModeration($id),
            'worksForDebriefing' => $this->workRepository->getWorksForDebriefing($id),
            'user' => $this->user(),
        ]);
    }

    public function createCompetition(FormCreatCompetitionRequest $formRequest)
    {
        $competition = $this->competitionRepository->createCompetition($formRequest->all());

        return redirect(route('a-competition', ['id' => $competition->id]));
    }

    public function createExpressCompetition(FormCreatCompetitionRequest $formRequest)
    {
        $this->competitionRepository->createExpressCompetition($formRequest->all());

        return redirect()->back();
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
