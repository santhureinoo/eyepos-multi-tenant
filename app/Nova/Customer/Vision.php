<?php

namespace App\Nova\Customer;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Http\Requests\NovaRequest;

class Vision extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Customer\Vision::class;

    /**
     * Show resource in navigation bar.
     */
    public static $displayInNavigation = false;

    /*
     * Name of Resource.
     */
    public static function label()
    {
        return 'Prescriptions';
    }

    public static function pluralLabel() {return 'Company';}
    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
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
        return [
            BelongsTo::make('Customer'),
            Text::make('Sphere', function () {
                return $this->left_sphere . '/' . $this->right_sphere;
            })->exceptOnForms(),
            Text::make('Cyl', function () {
                return $this->left_cyl . '/' . $this->right_cyl;
            })->exceptOnForms(),
            Text::make('Axis', function () {
                return $this->left_axis . '/' . $this->right_axis;
            })->exceptOnForms(),
            Text::make('Visual Acuity', function () {
                return $this->left_visual_acuity . ' / ' . $this->right_visual_acuity;
            })->exceptOnForms(),
            Text::make('PD', function () {
                return $this->left_pd . '/' . $this->right_pd;
            })->exceptOnForms(),
            Text::make('ADD', function () {
                return $this->left_add . '/' . $this->right_add;
            })->exceptOnForms(),
            Date::make('Date', 'created_at')->format('D/M/Y')
                ->exceptOnForms(),

            Number::make('Right Sphere', 'right_sphere')
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Left Sphere', 'left_sphere')
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Right Cyl', 'right_cyl')
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Left Cyl', 'left_cyl')
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Right Axis', 'right_axis')
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Left Axis', 'left_axis')
                ->onlyOnForms()
                ->size('w-1/2'),
            Select::make('Right Visual Acuity', 'right_visual_acuity')
                ->options(function () {
                    return config('prescription.options.' . config('prescription.default_version'));
                })
                ->onlyOnForms()
                ->size('w-1/2'),
            Select::make('Left Visual Acuity', 'left_visual_acuity')
                ->options(function () {
                    return config('prescription.options.' . config('prescription.default_version'));
                })
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Right PD', 'right_pd')
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Left PD', 'left_pd')
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Right ADD', 'right_add')
                ->onlyOnForms()
                ->size('w-1/2'),
            Number::make('Left ADD', 'left_add')
                ->onlyOnForms()
                ->size('w-1/2'),
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
        return [];
    }
}
