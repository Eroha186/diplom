<?php


namespace App\Console\CronProcess;


use App\Diplom;
use App\Mail\ExpressCompetitionDiplom;
use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class SendingMailExpressCompetitionDiplom
{
    static public function sendingMailExpressCompetitionDiplom()
    {
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
    }
}