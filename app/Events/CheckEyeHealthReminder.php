<?php

namespace App\Events;

use App\Models\Customer\Visit;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CheckEyeHealthReminder
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Visit Instance.
     *
     * @var \App\Models\Customer\Visit
     */
    public $visit;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
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
