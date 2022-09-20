<?php

namespace App\Listeners;

use App\Events\CustomerExaminationProcessed;
use App\Mail\ExaminationReport;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class SendCustomerExaminationReport
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
    public function handle(CustomerExaminationProcessed $event)
    {
        view()->share('examination', $event->examination);
        $pdf = PDF::loadView('examination.report.show');

        Mail::to($event->examination->customer->email)
            ->send(new ExaminationReport($event->examination));
    }
}
