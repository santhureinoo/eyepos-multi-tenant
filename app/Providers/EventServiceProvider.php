<?php

namespace App\Providers;

use App\Events\CheckEyeHealthReminder;
use App\Events\CustomerExaminationProcessed;
use App\Events\CustomerVisitProcessed;
use App\Listeners\SendCustomerExaminationReport;
use App\Listeners\SendCustomerSatisfactionSurvey;
use App\Listeners\SendEyeHealthReminder;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        CustomerVisitProcessed::class       => [
            SendCustomerSatisfactionSurvey::class
        ],
        CustomerExaminationProcessed::class => [
            SendCustomerExaminationReport::class
        ],
        CheckEyeHealthReminder::class       => [
            SendEyeHealthReminder::class
        ],
        Registered::class                   => [
            SendEmailVerificationNotification::class,
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
