<?php

namespace App\Listeners;

use App\Events\SuccessMailSend as SuccessMailSendAlias;
use App\Events\UpdateNumberMail;
use App\Mailing;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class UpdateNumberMailListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param SuccessMailSendAlias $event
     * @return void
     */
    public function handle(SuccessMailSendAlias $event)
    {
        Mailing::where('id', $event->idMailing)->update([
            'number_mail' => ++Mailing::select(['id', 'number_mail'])->where('id', $event->idMailing)->first()->number_mail,
        ]);
    }
}
