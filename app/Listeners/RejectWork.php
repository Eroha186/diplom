<?php

namespace App\Listeners;

use App\Diplom;
use App\Events\RejectedWork;
use App\Http\Controllers\TransactionController;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class RejectWork
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        $this->cash = config('payment_config.cash');
    }

    /**
     * Handle the event.
     *
     * @param RejectedWork $event
     * @return void
     */
    public function handle(RejectedWork $event)
    {
        $diplom = Diplom::with($event->typeWork, $event->typeWork . ".user")->where([
            ['work_id', $event->workId],
            ['type', $event->typeWork],
            ['payment', 1]
        ])->get()->first()->toArray();

        if (count($diplom) > 0) {
            if ($diplom['payment']) {
                $userId = $diplom[$event->typeWork]['user']['id'];
                $user = User::where('id', $userId);

                $user->update([
                    'coins' => $this->cash + $user->select('coins')->first()['coins'],
                ]);

                (new TransactionController())->transferCoins(
                    [
                        'user_id' => $userId,
                        'type' => 1,
                        'coins' => $this->cash,
                    ]
                );
            }
        }
    }
}
