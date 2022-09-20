<?php

namespace App\Nova\Actions;

use App\Models\Customers;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Actions\DestructiveAction;
use Laravel\Nova\Fields\ActionFields;

class IntakeToCustomer extends DestructiveAction
{
    use InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The displayable name of the action.
     *
     * @var string
     */
    public $name = 'Convert to Customer';

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
            $customer             = new Customers();
            $customer->first_name = $model->first_name ?? null;
            $customer->last_name  = $model->last_name ?? null;
            $customer->phone      = $model->phone ?? null;
            $customer->email      = $model->email ?? null;

            $customer->consent_marketing     = Str::contains($model->consent, 'consent_promotions');
            $customer->consent_notifications = Str::contains($model->consent, 'consent_communication');

            $customer->save();

            // "Archive" Them
            $model->converted = true;
            $model->save();
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
