<?php

namespace App\Console;

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
            $diploms = Diplom::where([
                ['created_at', '<=', Carbon::now()->subDay()->subHours(12)],
                ['mailing', 0]
            ])->get();
            foreach ($diploms as $diplom) {
                $type = $diplom->type;
                $item = Diplom::with($type, $type . '.user')->where('id', $diplom->id)->first();
                Mail::to($item->$type->user->email)->send(new ExpressCompetitionDiplom($item));
                Diplom::where('id', $diplom->id)->update([
                   'mailing' => 1,
                ]);
            }
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
