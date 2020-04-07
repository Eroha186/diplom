<?php


namespace App\Repositories\Works;


use App\Work;
use Illuminate\Support\Facades\Auth;

class WorkRepository extends WorksRepository
{

    public function getWorkUser()
    {
        return $this->formatWork(Work::with($this->field)->where('user_id', Auth::user()->id)->get());
    }

}