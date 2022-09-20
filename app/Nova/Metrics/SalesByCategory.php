<?php

namespace App\Nova\Metrics;

use App\Models\Inventory\Category;
use App\Models\Order;
use Illuminate\Support\Str;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class SalesByCategory extends Partition
{
    /**
     * Calculate the value of the metric.tr
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        $orders     = Order::where('category', '!=', null)->get();
        $categories = Category::all();

        ray($categories);
        $groups     = [];
        foreach ($categories as $category) {//
            $groups[$category->name] = 0;
        }

        foreach ($orders as $order) {
            $category          = Str::headline($order->category);
            $groups[$category] += $order->total;
        }

        return $this->result($groups);
//        return $this->count($request, Order::class, 'category', 'total')
//            ->label(function ($value) {
//                switch ($value) {
//                    case null:
//                        return 'None';
//                    default:
//                        return Str::title($value);
//                }
//            });
        ;
    }

    /**
     * Determine for how many minutes the metric should be cached.
     *
     * @return  \DateTimeInterface|\DateInterval|float|int
     */
    public function cacheFor()
    {
        // return now()->addMinutes(5);
    }

    /**
     * Get the URI key for the metric.
     *
     * @return string
     */
    public function uriKey()
    {
        return 'sales-by-category';
    }
}
