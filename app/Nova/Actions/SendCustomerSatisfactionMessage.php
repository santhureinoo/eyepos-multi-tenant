<?php

namespace App\Nova\Actions;

use App\Mail\CustomerSatisfactionForm;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\URL;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class SendCustomerSatisfactionMessage extends Action
{
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param \Laravel\Nova\Fields\ActionFields $fields
     * @param \Illuminate\Support\Collection    $models
     *
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models)
    {
        foreach ($models as $model) {
            $url = URL::signedRoute('satisfaction.show', ['visit' => $model->id]);
            Mail::to($model->customer->email)->send(new CustomerSatisfactionForm($url));
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
