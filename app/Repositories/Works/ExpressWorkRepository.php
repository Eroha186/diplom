<?php


namespace App\Repositories\Works;


use App\ExpressWork;
use Illuminate\Support\Facades\Auth;

class ExpressWorkRepository extends WorksRepository
{
    public function getWorkUser()
    {
        return $this->formatWork(ExpressWork::with($this->field)->where('user_id', Auth::user()->id)->get());
    }
}