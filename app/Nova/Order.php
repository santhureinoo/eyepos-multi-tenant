<?php

namespace App\Nova;

use App\Nova\Actions\DownloadReceiptPDF;
use App\Nova\Inventory\Supplier;
use Eyespos\CalculatedField\ReactiveBelongsTo;
use Eyespos\CalculatedField\ReactiveBoolean;
use Eyespos\CalculatedField\ReactiveCurrency;
use Eyespos\CalculatedField\ReactiveHidden;
use Eyespos\CalculatedField\ReactiveNumber;
use Illuminate\Http\Request;
use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Panel;
use Illuminate\Support\Arr;

class Order extends Resource
{
    public $item;
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Order::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

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
    public static $priority = 3;

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
            new Panel('Items', $this->returnItemFields()),
            new Panel('Services', $this->returnServiceFields()),
            new Panel('Total', $this->returnTotalFields()),

            BelongsTo::make('Customer')
                ->searchable(true)
                ->size('w-1/3')
                ->nullable(true),

            BelongsTo::make('Supplier', 'supplier', Supplier::class)
                ->searchable(true)
                ->size('w-1/3')
                ->nullable(true)
                ->hideFromIndex(),

            Text::make('Custom')
                ->size('w-1/3')
                ->nullable(true)
                ->hideFromIndex(),

            Textarea::make('Description')
                ->size('w-full'),

            BelongsTo::make('User')
                ->withMeta([
                    'belongsToId' => \Auth::id()
                ])
                ->size('w-1/3')
                ->hideFromIndex()
        ];
    }

    public function returnItemFields()
    {
        return [
            ReactiveBelongsTo::make('Product', 'inventory', Inventory::class)
                ->displayUsing(function ($inventory) {
                    return $this->resolveInventoryName($inventory);
                })
                ->emit('inventory-input')
                ->size('w-2/3')
                ->searchable(true)
                ->nullable(true)
                ->onlyOnForms(),

            ReactiveNumber::make('Quantity', 'quantity')
                ->emit('qty-item')
                ->on(['inventory-input'])
                ->handle(function (Collection $col) {
                    return 1;
                })
                ->size('w-1/3'),

            ReactiveNumber::make('Discount', 'discount-item')
                ->emit('discount-item')
                ->size('w-1/3')
                ->hideFromIndex()
                ->dontFill(),

            ReactiveBoolean::make('Fixed Amount?', 'discount-item-fixed')
                ->emit('discount-item-fixed')
                ->dontFill()
                ->size('w-1/3')
                ->onlyOnForms(),

            ReactiveCurrency::make('Item Sell Price', 'price-item')
                ->currency(config('setup.financials.currency'))
                ->on(['inventory-input', 'discount-item', 'price-item', 'discount-item-fixed'])
                ->handle(function (Collection $col) {
                    $item = \App\Models\Inventory::query()->find($col->get('inventory'))->price_selling;
                    if ($col->get('discount-item-fixed')) {
                        $discount = $item - $col->get('discount-item');
                    } else {
                        $discount = ($col->get('discount-item') / 100) * $item;
                    }

                    return max($item + $discount, 0);
                })
                ->emit('inventory-value')
                ->size('w-1/3')
                ->hideFromIndex()
                ->dontFill(),

            Text::make('Inventory')->displayUsing(function ($inventory) {
                return $this->resolveInventoryName($inventory);
            })->exceptOnForms(),

            ReactiveHidden::make('inventory_id')->on(['inventory-input'])
                ->handle(function (Collection $col) {
                    return \App\Models\Inventory::query()->find($col->get('inventory'))->id;
                }),

            ReactiveHidden::make('service_id')->on(['service-input'])
                ->handle(function (Collection $col) {
                    return \App\Models\ServiceOffers::query()->find($col->get('service'))->id;
                }),

            ReactiveHidden::make('category')->on(['inventory-input'])
                ->handle(function (Collection $col) {
                    return \App\Models\Inventory::query()->find($col->get('inventory'))->category;
                }),

            ReactiveHidden::make('brand')->on(['inventory-input'])
                ->handle(function (Collection $col) {
                    return \App\Models\Inventory::query()->find($col->get('inventory'))->brand->name;
                }),
        ];
    }

    public function returnServiceFields()
    {
        return [
            ReactiveBelongsTo::make('Service', 'service', ServiceOffer::class)
                ->emit('service-input')
                ->size('w-1/3')
                ->nullable(true),

            ReactiveNumber::make('Discount', 'discount-service')
                ->emit('discount-service')
                ->size('w-1/3')
                ->dontFill(),

            ReactiveBoolean::make('Fixed Amount?', 'discount-service-fixed')
                ->emit('discount-service-fixed')
                ->dontFill()
                ->size('w-1/3')
                ->onlyOnForms(),

            ReactiveCurrency::make('Service Sell Price', 'price-service')
                ->currency(config('setup.financials.currency'))
                ->on(['service-input', 'discount-service', 'service-item', 'discount-service-fixed'])
                ->handle(function (Collection $col) {
                    $item = \App\Models\ServiceOffers::query()->find($col->get('service'))->price;
                    if ($col->get('discount-service-fixed')) {
                        $discount = $item - $col->get('discount-service');
                    } else {
                        $discount = ($col->get('discount-service') / 100) * $item;
                    }

                    return max($item + $discount, 0);
                })
                ->emit('service-value')
                ->size('w-1/3')
                ->hideFromIndex()
                ->dontFill(),
        ];
    }

    public function resolveInventoryName($inventory)
    {
        // Contact Lense: Category + Type + Subtype + Brand + Prescription + BaseCurve + Diameter + Colour
        // Frames: (MN) Category + Brand + Size + Material + Colour
        // Accessories: Description
        // Sunglasses: Frames + Lens Colour
        // Op Lens: Category + Type + Brand + Index + Lens Colour
        $str = '';
        if ($inventory->category === 'contact_lenses') {
            $str = Str::headline($inventory->category . '-' . $inventory->type . '-' . $inventory->brand->name . '-' . $inventory->prescription . '-' . $inventory->base_curve . '-' . $inventory->diameter . '-' . $inventory->color_lens);
        }
        if ($inventory->category === 'frames') {
            $str = Str::headline($inventory->category . '-' . $inventory->brand->name . '-' . $inventory->size . '-' . $inventory->material . '-' . $inventory->color_frame);
        }
        if ($inventory->category === 'sunglasses') {
            $str = Str::headline($inventory->category . '-' . $inventory->brand->name . '-' . $inventory->size . '-' . $inventory->material . '-' . $inventory->color_frame . '-' . $inventory->color_lens);
        }
        if ($inventory->category === 'ophthalmic') {
            $str = Str::headline($inventory->category . '-' . $inventory->type . '-' . $inventory->brand->name . '-' . $inventory->index . '-' . $inventory->color_lens);
        }
        if ($inventory->category === 'accessories') {
            $str = Str::headline($inventory->description);
        }

        return $str;
    }

    public function returnTotalFields()
    {
        return [
            ReactiveCurrency::make('Total')
                ->currency(config('setup.financials.currency'))
                ->on(['inventory-input', 'service-input', 'inventory-value', 'service-value', 'inventory-gst-value', 'price-modifier-discount', 'discount-fixed'])
                ->handle(function (Collection $col) {
                    $items = $col->get('price-item') + $col->get('price-service');
                    $total = max($items, 0);
                    $tax   = ((config('setup.financials.gst')) / 100) * $total;

                    return $total + $tax;
                })
                ->size('w-2/3'),

            ReactiveCurrency::make('GST', 'gst')
                ->currency(config('setup.financials.currency'))
                ->on(['inventory-input', 'service-input', 'inventory-value', 'service-value', 'inventory-gst-value', 'price-modifier-discount', 'discount-fixed'])
                ->handle(function (Collection $col) {
                    $items = $col->get('price-item') + $col->get('price-service');

                    return ((config('setup.financials.gst')) / 100) * $items;
                })
                ->emit('inventory-gst-value')
                ->size('w-1/3')
                ->readonly()
                ->hideFromIndex(),
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
            new DownloadReceiptPDF()
        ];
    }
}
