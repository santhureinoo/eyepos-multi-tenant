<?php

namespace App\Nova\Dashboards;

use App\Nova\Metrics\OrdersPerDay;
use App\Nova\Metrics\SalesByCategory;
use App\Nova\Metrics\TotalOrders;
use App\Nova\Metrics\TotalSales;
use Laravel\Nova\Dashboard;

class SaleInsights extends Dashboard
{
    /**
     * Get the displayable name of the dashboard.
     *
     * @return string
     */
    public static function label()
    {
        return 'Sales Insights';
    }

    /**
     * Get the cards for the dashboard.
     *
     * @return array
     */
    public function cards()
    {
        return [
            new TotalSales(),
            new TotalOrders(),
            new OrdersPerDay(),
            new SalesByCategory()
        ];
    }

    /**
     * Get the URI key for the dashboard.
     *
     * @return string
     */
    public static function uriKey()
    {
        return 'sale-insights';
    }
}
