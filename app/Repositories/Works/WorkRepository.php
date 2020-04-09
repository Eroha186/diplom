<?php


namespace App\Repositories\Works;


use App\Work;
use Illuminate\Support\Facades\Auth;

class WorkRepository extends WorksRepository
{

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