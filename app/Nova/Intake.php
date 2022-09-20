<?php

namespace App\Nova;

use App\Nova\Actions\IntakeToCustomer;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BooleanGroup;
use Laravel\Nova\Http\Requests\NovaRequest;
use Fourstacks\NovaCheckboxes\Checkboxes;


class Intake extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Intake::class;

    /**
     * Build an "index" query for the given resource.
     */
    public static function indexQuery(NovaRequest $request, $query)
    {
        return $query->where('converted', false);
    }

    /*
     * Disallow Create.
     */
    public static function authorizedToCreate(Request $request)
    {
        return true;
    }

    /*
     * Disallow Update.
     */
    public function authorizedToUpdate(Request $request)
    {
        return true;
    }

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'email';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'email',
        'phone',
        'first_name',
        'last_name'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        $outlet_id = intval($request->session()->get('outlet_id'));

        return [
            Text::make('Outlet ID', 'outlet_id')
                ->default($outlet_id)
                ->withMeta(['extraAttributes' => [
                    'readonly' => true
                ]]),

            Text::make('Name', function () {
                return $this->first_name . ' ' . $this->last_name;
            })->exceptOnForms(),
            Text::make('First Name'),
            Text::make('Last Name'),
            Text::make('Email'),
            Text::make('Phone'),
            Text::make('Age'),
            Text::make('Currently Wearing'),
            Checkboxes::make('Currently Wearing')->options([
                'no_contacts' => 'No contact lenses',
                'hard_contacts' => 'Hard contact lenses',
                'soft_contacts' => 'Soft contact lenses',
                'single_far' => 'Single vision glasses for seeing fars',
                'reading_near' => 'Reading glasses (for seeing near)',
                'progressives' => 'Progressives (for seeing near and far)',
            ])->saveAsString(),
            Checkboxes::make('Conditions')->options([
                'High Blood Pressure' => 'High Blood Pressure',
                'Diabetes' => 'Diabetes',
                'Thyroids' => 'Thyroid',
                'High Cholesterol' => 'High Cholesterol',
                'High Myopia' => 'High Myopia',
                'Lazy eye' => 'Lazy eye',
                'Smoking' => 'Smoking',
                'Drinker (Alcohol)' => 'Drinker (Alcohol)',
            ])->saveAsString(),
            Checkboxes::make('Tick if you have the following personal or family history of eye illnesses, injury or surgery', 'history')->options([
                'detachment' => 'Retinal Detachment',
                'pigmentosa' => 'Retinitis Pigmentosa',
                'glaucoma' => 'Glaucoma',
                'degeneration' => 'Age-related Macular Degeneration',
                'myopia' => 'High Myopia',
                'trauma' => 'Trauma to the eye',
                'lasik' => 'Lasik',
                'other' => 'Other surgery'
            ])->saveAsString(),
            Checkboxes::make('When did you last change your glasses', 'last_change')->options([
                'less_year' => 'Less than a year',
                'year' => 'One year + ago',
                'three_years' => 'Two to three years ago',
                'more_three' => 'More than three years ago'
            ])->saveAsString(),
            Boolean::make('Issues Near'),
            Boolean::make('Issues Far'),
            Text::make('Other')
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
            new IntakeToCustomer()
        ];
    }
}
