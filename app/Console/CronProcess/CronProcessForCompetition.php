<?php


namespace App\Console\CronProcess;


use App\Competition;
use Illuminate\Support\Carbon;

class CronProcessForCompetition
{
    static public function switchingStatusSummarizing() {
        Competition::where('date_end', '<=', Carbon::now()->format("Y-m-d h:i:s"))->update([
            'status' => 1,
        ]);
    }
}