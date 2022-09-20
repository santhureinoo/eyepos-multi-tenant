<?php

namespace App\Listeners;

use App\Events\CheckEyeHealthReminder;
use App\Mail\Customer\Reminders\EyeCheckReminderForm;
use App\Models\Customer\Visit;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendEyeHealthReminder
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct(Visit $visit)
    {
        $this->visit = $visit;
    }

    /**
     * Handle the event.
     *
     * @param  object  $event
     * @return void
     */
    public function handle(CheckEyeHealthReminder $event)
    {
        Mail::to($event->visit->customer->email)->send(new EyeCheckReminderForm($event->visit->customer));
    }
}
