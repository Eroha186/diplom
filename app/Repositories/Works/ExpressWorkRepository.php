<?php


namespace App\Repositories\Works;


use App\ExpressWork;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;

class ExpressWorkRepository extends WorksRepository
{
    public function getWorkUser()
    {
        return $this->formatWork(ExpressWork::with($this->fields)->where('user_id', Auth::user()->id)->get());
    }

    public function createWork($data)
    {
        return ExpressWork::create([
            'user_id' => $data['user_id'],
            'title' => $data['title'],
            'competition_id' => $data['competition'],
            'annotation' => $data['annotation'],
            'fc' => $data['fc'],
            'ic' => $data['ic'],
            'oc' => $data['oc'],
            'nomination_id' => (int) $data['nomination'],
            'date_add' => Carbon::now()->format("Y-m-d H:i:s"),
            'age' => $data['age'],
            'place' => $this->randomPlace(),
        ]);
    }

    protected function randomPlace()
    {
        $place = [1,2,2,3,3,3,4,4,4,4];
        return $place[array_rand($place, 1)];
    }
}
