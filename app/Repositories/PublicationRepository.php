<?php


namespace App\Repositories;


use App\Publication;
use Illuminate\Support\Facades\Auth;

class PublicationRepository
{
    protected $field = [
        'user',
        'diplom',
        'type',
        'education',
        'kind',
        'files',
    ];

    public function getAllPublicationUser()
    {
        return $this->formatPublication(Publication::with($this->field)->where('user_id', Auth::user()->id)->get());
    }

    protected function formatPublication($publications)
    {
        foreach ($publications as $publication) {
            $publication['date_add'] = date("d.m.Y", strtotime($publication['date_add']));
            $publication['user']['i'] = mb_substr($publication['user']['i'], 0, 1);
            $publication['user']['o'] = mb_substr($publication['user']['o'], 0, 1);
        }

        return $publications;
    }
}