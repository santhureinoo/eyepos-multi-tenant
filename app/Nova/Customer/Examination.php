<?php

namespace App\Nova\Customer;

use App\Nova\Actions\SendExaminationReport;
use App\Nova\Resource;
use DigitalCreative\ConditionalContainer\HasConditionalContainer;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;

class Examination extends Resource
{
    use HasConditionalContainer;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Customer\Examination::class;

    /**
     * Show resource in navigation bar.
     */
    public static $displayInNavigation = false;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'customer';

    /**
     * Get the value that should be displayed to represent the resource.
     *
     * @return string
     */
    public function title()
    {
        if (! isset($this->visit->purpose) || $this->visit->purpose === null) {
            return '-';
        }

        return $this->visit->purpose ?? null . ' (' . $this->visit->created_at . ')';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'category',
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
        return '/resources/customers/' . $resource->customer->id . '?tab=examinations';
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
        return '/resources/customers/' . $resource->customer->id . '?tab=examinations';
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
            BelongsTo::make('Customer')
                ->searchable()
                ->hideFromIndex(),
            Select::make('Category')
                ->options([
                    'Acuity Test'         => 'Acuity Test',
                    'Refraction Eye Test' => 'Refraction Eye Test',
                    'Field Test'          => 'Field Test',
                    'Slit-lamp Exam'      => 'Slit-lamp Exam',
                    'Glaucoma Test'       => 'Glaucoma Test',
                    'Color blind Test'    => 'Color blind Test',
                    'Retinoscopy'         => 'Retinoscopy'
                ])
                ->onlyOnForms(),

            Text::make('Category')->displayUsing(function ($category) {
                return ucfirst($category);
            })->exceptOnForms(),

            BelongsTo::make('Visit')
                ->displayUsing(function ($visit) {
                    if (! isset($visit->purpose) || $visit->purpose === null) {
                        return '-';
                    }

                    return date('d-m-Y', strtotime($visit->created_at)) . ' - ' . $visit->purpose ?? null;
                })
                ->nullable(),

            new Panel('Ocular Tests', $this->ocularTestFields()),
            new Panel('Recommendations', $this->recommendationFields()),
        ];
    }

    /**
     * Get the examination fields for the resource.
     *
     * @return array
     */
    protected function ocularTestFields()
    {
        return [
            Text::make('Pupillary Reflex')->hideFromIndex(),
            Text::make('Eyelids')->hideFromIndex(),
            Text::make('Tear Film')->hideFromIndex(),
            Text::make('Conjunctiva')->hideFromIndex(),
            Text::make('Cornea')->hideFromIndex(),
            Text::make('Iris')->hideFromIndex(),
            Text::make('Crystalline Lens')->hideFromIndex(),
            Text::make('Retinal Blood Vessels')->hideFromIndex(),
            Text::make('Optic Nerve')->hideFromIndex(),
            Text::make('Macula')->hideFromIndex(),
            Text::make('Retina Posterior Pole')->hideFromIndex(),
            Text::make('Eye Pressure')->hideFromIndex(),
        ];
    }

    /**
     * Get the recommendation fields for the resource.
     *
     * @return array
     */
    protected function recommendationFields()
    {
        return [
            BooleanGroup::make('Recommendations')
                ->options($options = [
                    'rec_prescription'  => 'New Prescription Glasses',
                    'rec_referral'      => 'Refer to ophthalmologist for further investigation',
                    'rec_reexamination' => 'Re-examination in months',
                    'rec_myopia'        => 'Myopia management solutions e.g. spectacle lenses',
                    'rec_supplements'   => 'Supplements e.g. preservative free eye drops/eye supplements',
                ])
                ->fillUsing(
                    function (NovaRequest $request, \App\Models\Customer\Examination $model, string $attribute, string $requestAttribute) {
                        // Make sure the `recommendations` value exists on the request.
                        if (! $request->exists($requestAttribute)) {
                            return;
                        }
                        // Decode the values because it is send as a JSON blob.
                        $values = json_decode($request[$requestAttribute], true);
                        // Hydrate the model.
                        foreach ($values as $key => $value) {
                            $model->{$key} = $value;
                        }
                    }
                )
                ->resolveUsing(
                    function ($value, \App\Models\Customer\Examination $model, string $attribute) use ($options) {
                        $keys   = array_keys($options);
                        $values = array_map(function ($value, $key) use ($model) {
                            return $model->{$key};
                        }, $options, $keys);

                        return array_combine($keys, $values);
                    }
                )
                ->hideFromIndex(),
            Text::make('Other', 'rec_other')
                ->hideFromIndex()
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
            new SendExaminationReport()
        ];
    }
}
