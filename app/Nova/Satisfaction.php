<?php

namespace App\Nova;

use App\Nova\Actions\SendCustomerSatisfactionMessage;
use App\Nova\Metrics\CustomerSatisfaction;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Text;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\NovaRequest;

class Satisfaction extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Satisfaction::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static function label()
    {
        return 'Surveys';
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'satisfaction',
        'purpose'
    ];

    public static function authorizedToCreate(Request $request)
    {
        return false;
    }

    public function authorizedToDelete(Request $request)
    {
        return false;
    }

    public function authorizedToUpdate(Request $request)
    {
        return false;
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
            Date::make('Date', 'created_at'),
            Text::make('Purpose'),
            Text::make('Procedure')
                ->displayUsing(function ($procedure) {
                    return Str::of($procedure)->headline()->replace(',', ', ');
                })
                ->hideFromIndex(),
            Text::make('Satisfaction')
                ->displayUsing(function ($satisfaction) {
                    $stars = '';
                    for ($i = 0; $i < $satisfaction; $i++) {
                        $stars .= ' ⭐️ ';
                    }

                    return $stars;
                }),
            Text::make('recommend')
                ->displayUsing(function ($recommend) {
                    return Str::of($recommend)->headline();
                }),
            Text::make('Visit'),
            Text::make('Improvement')
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
        return [
            new CustomerSatisfaction()
        ];
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
