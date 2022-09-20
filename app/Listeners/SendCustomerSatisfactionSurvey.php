<?php

namespace App\Listeners;

use App\Events\CustomerVisitProcessed;
use App\Mail\CustomerSatisfactionForm;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;

class SendCustomerSatisfactionSurvey
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
     * @param  object  $event
     * @return void
     */
    public function handle(CustomerVisitProcessed $event)
    {
        // TODO: Invalidate Signed Route
        $url = URL::signedRoute('satisfaction.show', ['visit' => $event->visit->id]);
        Mail::to($event->visit->customer->email)->send(new CustomerSatisfactionForm($url));
    }
}
