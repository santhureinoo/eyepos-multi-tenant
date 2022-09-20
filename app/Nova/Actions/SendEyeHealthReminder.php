<?php

namespace App\Nova\Actions;

use App\Events\CheckEyeHealthReminder;
use App\Models\Customer\Visit;
use Brightspot\Nova\Tools\DetachedActions\DetachedAction;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SendEyeHealthReminder extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * The displayable name of the action.
     *
     * @var string
     */
    public $name = 'Eye Health Check Reminder';

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection    $models
     *
     * @return mixed
     */
    public function handle(ActionFields $fields)
    {
        // TODO: Customize Period
        $now    = Carbon::now()->format('y-m-d');
        $visits = Visit::whereDate('created_at', $now)->get();

        foreach ($visits as $visit) {
            \App\Events\CheckEyeHealthReminder::dispatch($visit);
        }
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields()
    {
        return [];
    }
}
