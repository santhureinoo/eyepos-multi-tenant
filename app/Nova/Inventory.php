<?php

namespace App\Nova;

use DigitalCreative\ConditionalContainer\ConditionalContainer;
use DigitalCreative\ConditionalContainer\HasConditionalContainer;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Boolean;
use Laravel\Nova\Fields\Currency;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Http\Requests\NovaRequest;

class Inventory extends Resource
{
    use HasConditionalContainer;

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Inventory::class;

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
        'prescription'
    ];

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static $group = 'Services';

    /**
     * The side nav menu order.
     *
     * @var int
     */
    public static $priority = 2;

    /**
     * Rename Resource
     *
     * @return string
     */
    public static function label()
    {
        return 'Inventory';
    }

    /**
     * Build a "relatable" query for the given resource.
     *
     * This query determines which instances of the model may be attached to other resources.
     *
     * @param  \Laravel\Nova\Http\Requests\NovaRequest  $request
     * @param  \Illuminate\Database\Eloquent\Builder  $query
     * @param  \Laravel\Nova\Fields\Field  $field
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public static function relatableQuery(NovaRequest $request, $query)
    {
        return $query->where('quantity', '>', 0);
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
            Select::make('Category', 'category')
                ->options([
                    'contact_lenses' => 'Contact Lens',
                    'ophthalmic'   => 'Ophthalmic Lens',
                    'frames'       => 'Frames',
                    'sunglasses'   => 'Sunglasses',
                    'accessories'  => 'Accessories'
                ])
                ->displayUsing(function ($category) {
                    return ucwords($category);
                }),

            ID::make('Name', 'id')
                ->exceptOnForms(),
            Tabs::make('Details', [
                Tab::make('Overview', [
                    BelongsTo::make('Supplier', 'supplier', 'App\Nova\Inventory\Supplier'),
                    BelongsTo::make('Brand', 'brand', 'App\Nova\Inventory\Brand')->searchable(),
                    Text::make('Description')
                        ->hideFromIndex(),

                    ConditionalContainer::make([
                        Select::make('Type')
                            ->options(['disposable' => 'Disposable'])
                    ])
                        ->if('category = "contact_lens"'),

                    ConditionalContainer::make([
                        Select::make('Sub Type', 'sub_type')
                            ->options([
                                'dailies'   => 'Dailies',
                                'weekly'    => 'Weekly',
                                'bi_weekly' => 'Bi-weekly',
                                'monthly'   => 'Monthly'
                            ])
                    ])
                        ->if('category = "contact_lens"'),

                    ConditionalContainer::make([
                        Select::make('Type')
                            ->options([
                                'pal'      => 'PAL',
                                'sv'       => 'SV',
                                'bi_focal' => 'Bi-Focal'
                            ])
                    ])
                        ->if('category = "ophthalmic"'),

                    ConditionalContainer::make([
                        Select::make('Type')
                            ->options([
                                'multi-purpose_solution' => 'Multi-purpose solution',
                                'saline'                 => 'Saline',
                                'chains'                 => 'Chains',
                                'hook'                   => 'Hook',
                                'spray'                  => 'Spray',
                                'lens_wipes'             => 'Lens Wipes',
                                'lens_cleaner'           => 'Lens Cleaner',
                                'eye_vitamins'           => 'Eye Vitamins',
                            ])
                    ])
                        ->if('category = "accessories"'),

                    Number::make('Quantity'),
                    Date::make('Purchased Date', 'purchase_at')
                        ->hideFromIndex(),
                    Date::make('Soldout Date', 'soldout_at')
                        ->hideFromIndex(),
                ]),

                Tab::make('Details', [
                    // TODO: Number conditions
                    ConditionalContainer::make([Number::make('Prescription')])
                        ->if('category = "contact_lens"')
                        ->if('category = "frames"'),

                    ConditionalContainer::make([
                        Select::make('Base Curve', 'base_curve')
                            ->options([
                                '8.4' => '8.4',
                                '8.6' => '8.6'
                            ])
                    ])
                        ->if('category = "contact_lens"'),

                    ConditionalContainer::make([Text::make('Diameter')])
                        ->if('category = "contact_lens"'),

                    ConditionalContainer::make([
                        Select::make('Lens Color', 'color_lens')
                            ->options([
                                'clear'       => 'Clear',
                                'color'       => 'Color',
                                'transitions' => 'Transitions',
                                'tinted'      => 'Tinted'
                            ])
                    ])
                        ->if('category = "contact_lens"')
                        ->if('category = "ophthalmic"'),

                    ConditionalContainer::make([
                        Text::make('Lens Color Code', 'color_lens_code')
                    ])
                        ->if('category = "contact_lens"')
                        ->if('category = "ophthalmic"'),

                    ConditionalContainer::make([
                        Select::make('Frame Color', 'color_frame')
                            ->options([
                                'silver'   => 'Silver',
                                'gold'     => 'Gold',
                                'bronze'   => 'Bronze',
                                'gun'      => 'Gun',
                                'black'    => 'Black',
                                'white'    => 'White',
                                'red'      => 'Red',
                                'green'    => 'Green',
                                'blue'     => 'Blue',
                                'brown'    => 'Brown',
                                'clear'    => 'Clear',
                                'tortoise' => 'Tortois',
                                'grey'     => 'Grey',
                                'yellow'   => 'Yellow',
                                'orange'   => 'Orange',
                                'pink'     => 'Pink',
                                'purple'   => 'Purple',
                                'striped'  => 'Striped',
                                'floral'   => 'Floral'
                            ])
                    ])
                        ->if('category = "frames"')
                        ->if('category = "sunglasses"'),

                    ConditionalContainer::make([
                        Text::make('Frame Color Code', 'color_frame_code')
                    ])
                        ->if('category = "frames"')
                        ->if('category = "sunglasses"'),

                    ConditionalContainer::make([Text::make('Model Number', 'model_number')])
                        ->if('category = "frames"')
                        ->if('category = "sunglasses"'),

                    ConditionalContainer::make([Text::make('Size')])
                        ->if('category = "frames"')
                        ->if('category = "sunglasses"'),

                    ConditionalContainer::make([
                        Select::make('Material')
                            ->options([
                                'acetate'         => 'Acetate',
                                'nylon'           => 'Nylon',
                                'titanium'        => 'Titanium',
                                'beta'            => 'Beta',
                                'monel'           => 'Monel',
                                'beryllium'       => 'Beryllium',
                                'stainless steel' => 'Stainless steel',
                                'flexon'          => 'Flexon',
                                'aluminum'        => 'Aluminum',
                                'wood'            => 'Wood',
                                'horn'            => 'Horn',
                                'gold'            => 'Gold',
                                'silver'          => 'Silver',
                                'ultem'           => 'Ultem',
                            ])
                    ])
                        ->if('category = "frames"')
                        ->if('category = "sunglasses"'),

                    ConditionalContainer::make([
                        Select::make('Shape')
                            ->options([
                                'round'     => 'Round',
                                'rectangle' => 'Rectangle',
                                'oval'      => 'Oval',
                                'square'    => 'Square',
                                'cat'       => 'Cat',
                                'eyes'      => 'Eyes',
                                'brow'      => 'Brow',
                                'line'      => 'Line',
                                'aviator'   => 'Aviator',
                                'over'      => 'Over',
                                'sized'     => 'Sized',
                                'geometric' => 'Geometric',
                                'heart'     => 'Heart',
                            ])
                    ])
                        ->if('category = "frames"')
                        ->if('category = "sunglasses"'),
                ]),
                Tab::make('Pricing', [
                    Boolean::make('Consignment')
                        ->hideFromIndex(),
                    Currency::make('Cost Price', 'price_cost')
                        ->currency(config('setup.financials.currency'))
                        ->hideFromIndex(),
                    Currency::make('Recommended Selling Price', 'price_selling')
                    ->currency(config('setup.financials.currency'))
                        ->hideFromIndex(),
                ]),
                Tab::make('Orders', [
                    HasMany::make('Orders'),
                ]),
            ]),
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
        return [new Actions\ImportInventories];
    }

    public static function indexQuery(NovaRequest $request, $query)
    {
        $data = $request->session()->all();

        $outlet_id = $request->session()->get('outlet_id');

        return $query->where('outlet_id', intval($outlet_id));
    }
}
