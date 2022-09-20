<?php

namespace App\Nova\Metrics;

use App\Models\Satisfaction;
use Laravel\Nova\Http\Requests\NovaRequest;
use Laravel\Nova\Metrics\Partition;

class CustomerSatisfaction extends Partition
{
    /**
     * Calculate the value of the metric.
     *
     * @param \Laravel\Nova\Http\Requests\NovaRequest $request
     *
     * @return mixed
     */
    public function calculate(NovaRequest $request)
    {
        return $this->count($request, Satisfaction::class, 'satisfaction')
            ->label(function ($value) {
                switch ($value) {
                    case 1:
                        return 'Very Unsatisfied';
                    case 2:
                        return 'Unsatisfied';
                    case 3:
                        return 'Neutral';
                    case 4:
                        return 'Satisfied';
                    case 5:
                        return 'Very Satisfied';
                    default:
                        return ucfirst('No Rating');
                }
            })
            ->colors([
                1 => '#dc3545',
                2 => '#ffc107',
                3 => '#0d6efd',
                4 => '#17a2b8',
                5 => '#28a745',
            ]);
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
        return 'customer-satisfaction';
    }
}
