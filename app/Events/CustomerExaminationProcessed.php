<?php

namespace App\Events;

use App\Models\Customer\Examination;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CustomerExaminationProcessed
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * The Examination Instance.
     *
     * @var \App\Models\Customer\Examination
     */
    public $examination;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Examination $examination)
    {
        $this->examination = $examination;
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
