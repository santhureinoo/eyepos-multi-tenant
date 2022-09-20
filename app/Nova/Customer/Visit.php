<?php

namespace App\Nova\Customer;

use App\Nova\Actions\SendCustomerSatisfactionMessage;
use App\Nova\Actions\SendEyeHealthReminder;
use App\Nova\Resource;
use Customer\Examination;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\DateTime;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Visit extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Customer\Visit::class;

    /**
     * Show resource in navigation bar.
     */
    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'purpose';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'created_at',
        'purpose',
    ];

    /**
     * Return the location to redirect the user after creation.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Laravel\Nova\Resource                  $resource
     *
     * @return string
     */
    public static function redirectAfterCreate(NovaRequest $request, $resource)
    {
        return '/resources/customers/' . $resource->customer->id . '?tab=visits';
    }

    /**
     * Return the location to redirect the user after update.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     * @param \Laravel\Nova\Resource                  $resource
     *
     * @return string
     */
    public static function redirectAfterUpdate(NovaRequest $request, $resource)
    {
        return '/resources/customers/' . $resource->customer->id . '?tab=visits';
    }

    /**
     * Return the location to redirect the user after deletion.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return string|null
     */
    public static function redirectAfterDelete(NovaRequest $request)
    {
        return '/resources/customers';
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            BelongsTo::make('Customer'),
            DateTime::make('Date', 'created_at')
                ->format('DD-MM-Y H:mm')
                ->default(function ($request) {
                    return Carbon::now();
                }),
            Select::make('Purpose')
                ->options([
                    'Refraction Test'                     => 'Refraction test',
                    'Contact Lens Fitting'                => 'Contact lens fitting',
                    'Prescription Check'                  => 'Prescription Check',
                    'Eye Health Examination'              => 'Eye Health Examination',
                    'Eyeglasses Adjustments'              => 'Eyeglasses Adjustments',
                    'Contact Lens Purchase'               => 'Contact Lens Purchase',
                    'Eyeglasses Purchase'                 => 'Eyeglasses Purchase',
                    'Purchase Of Other Products/Services' => 'Purchase Of Other Products/Services',
                    'Collection Of Eyeglasses'            => 'Collection Of Eyeglasses',
                    'Collection Of Contact Lenses'        => 'Collection Of Contact Lenses',
                ]),
            new Panel('Examinations', $this->examinationFields()),
        ];
    }

    /**
     * Get the examination fields for the resource.
     *
     * @return array
     */
    protected function examinationFields()
    {
        return [
            HasMany::make('Examinations', 'examinations', '\App\Nova\Customer\Examination'),
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function cards(Request $request)
    {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function filters(Request $request)
    {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function lenses(Request $request)
    {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function actions(Request $request)
    {
        return [
            new SendCustomerSatisfactionMessage(),
            (new SendEyeHealthReminder())->standalone()
        ];
    }
}
