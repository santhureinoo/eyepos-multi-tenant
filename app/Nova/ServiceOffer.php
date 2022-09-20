<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class ServiceOffer extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ServiceOffers::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /*
     * Name of Resource.
     */
    public static function label()
    {
        return 'Services';
    }

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Inventory Management';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'name',
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
            Text::make('Name'),
            Currency::make('Price')->currency(config('setup.financials.currency'))
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

    public static function indexQuery(NovaRequest $request, $query)
    {
        $data = $request->session()->all();

        $outlet_id = $request->session()->get('outlet_id');

        return $query->where('outlet_id', intval($outlet_id));
    }
}
