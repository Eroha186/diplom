<?php


namespace App\Repositories;


use App\HistoryUnsubscribe;
use Carbon\Carbon;

class HistoryUnsubscribeRepository
{
    public function create($user_id, $event)
    {
        return HistoryUnsubscribe::create([
            'user_id' => $user_id,
            'event' => $event,
            'date_add' => date("Y-m-d H:i:s", strtotime(now())),
        ]);
    }
}