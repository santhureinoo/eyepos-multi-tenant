<?php

namespace App\Nova\Inventory;

use App\Nova\Resource;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Country;
use Laravel\Nova\Fields\Place;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Fields\Text;

class Supplier extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Inventory\Supplier::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name'
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Inventory Management';

    /**
     * Rename Resource
     *
     * @return string
     */
    public static function label()
    {
        return 'Suppliers';
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
        $outlet_id = intval($request->session()->get('outlet_id'));

        return [
            Text::make('Outlet ID', 'outlet_id')
                ->default($outlet_id)
                ->withMeta(['extraAttributes' => [
                    'readonly' => true
                ]]),
            Text::make('Name'),
            $this->addressFields(),
            //            RelationshipCount::make('Inventory', 'inventory'),
            //            HasMany::make('Inventory', 'inventory', 'App\Nova\Inventory')
        ];
    }

    /**
     * Get the address fields for the resource.
     *
     * @return \Illuminate\Http\Resources\MergeValue
     */
    protected function addressFields()
    {
        return $this->merge([
            Place::make('Address', 'address_line_1')->hideFromIndex(),
            Text::make('Address Line 2')->hideFromIndex(),
            Text::make('City')->hideFromIndex(),
            Text::make('State')->hideFromIndex(),
            Text::make('Postal Code')->hideFromIndex(),
            Text::make('Suburb')->hideFromIndex(),
            Country::make('Country')->hideFromIndex(),
        ]);
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
