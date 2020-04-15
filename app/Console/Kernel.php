<?php

namespace App\Console;

use App\Console\CronProcess\CronProcessForCompetition;
use App\Console\CronProcess\DeletingFilesThatNotRelatedToAnything;
use App\Console\CronProcess\SendingMailExpressCompetitionDiplom;
use App\Diplom;
use App\Mail\ExpressCompetitionDiplom;
use Carbon\Carbon;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\Mail;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        $schedule->call(function () {
            SendingMailExpressCompetitionDiplom::sendingMailExpressCompetitionDiplom();
            CronProcessForCompetition::switchingStatusSummarizing();
            DeletingFilesThatNotRelatedToAnything::deleteFiles();
        })->daily();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
