<?php

namespace App\Listeners;

use App\Events\SuccessMailSend;
use App\Mailing;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Queue;

class ChangeStatusMailingListener
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
     * @param  SuccessMailSend  $event
     * @return void
     */
    public function handle(SuccessMailSend $event)
    {
        if(Queue::size('default') <= 1) {
            Mailing::where('id', $event->idMailing)->update([
                'status' => 2,
            ]);
        }
    }
}
