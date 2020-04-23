<?php


namespace App\Repositories\Works;


use App\Http\Controllers\UploadFileController;
use App\Work;
use Illuminate\Support\Facades\Auth;

class WorkRepository extends WorksRepository
{

    const NUMBER_OF_PAGES_FOR_PAGINATION = 16;

    public function getWorkUser()
    {
        return $this->formatWork(Work::with($this->fields)->where('user_id', Auth::user()->id)->get());
    }

    public function getWorksForModeration($competition_id)
    {
        return Work::with($this->fields)->where([
            ['competition_id', $competition_id],
            ['moderation', 0],
            ['place', 0]
        ])->get();
    }

    public function getWorksForDebriefing($competition_id)
    {
        return Work::with($this->fields)->where([
            ['competition_id', $competition_id],
            ['moderation', 2],
            ['place', 0]
        ])->get();
    }

    public function getWorkForCompetition($competition_id)
    {
        return Work::with($this->fields)->where([
            ['competition_id', $competition_id],
            ['moderation', 2],
        ])->paginate(self::NUMBER_OF_PAGES_FOR_PAGINATION);
    }

    public function getCountWorksInCompetition($competition_id)
    {
        return count(Work::where([
            ['competition_id', $competition_id],
            ['moderation', 2],
        ])->get());
    }

    public function getWork($id)
    {
        return Work::with($this->fields)->where('id', $id)->get()->first();
    }

    public function createWork($data)
    {
        $work = Work::create([
            'user_id' => $data['user_id'],
            'competition_id' => $data['competition'],
            'title' => $data['title'],
            'annotation' => $data['annotation'],
            'fc' => $data['fc'],
            'ic' => $data['ic'],
            'oc' => $data['oc'],
            'nomination_id' => (int) $data['nomination'],
            'date_add' => date('Y-m-d H:i:s', time()),
            'age' => $data['age'],
        ]);

        return $work;
    }

    public function confirmWork($id)
    {
        Work::where('id', $id)->update([
            'moderation' => 2,
        ]);
    }

    public function rejectWork($id)
    {
        Work::where('id', $id)->update([
            'moderation' => 1,
        ]);
    }
}