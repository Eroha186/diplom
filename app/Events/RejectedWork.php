<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RejectedWork
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $workId;
    public $typeWork;

    /**
     * Create a new event instance.
     *
     * @param $workId
     * @param $type
     * @param $userId
     */
    public function __construct($workId, $type)
    {
        $this->workId = $workId;
        $this->typeWork = $type;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
