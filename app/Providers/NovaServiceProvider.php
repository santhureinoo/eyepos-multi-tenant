<?php

namespace App\Providers;

use App\Nova\Dashboards\SaleInsights;
use App\Nova\Role;
use App\Nova\Metrics\TotalCustomers;
use App\Nova\Metrics\CustomersPerDay;
use ChrisWare\NovaBreadcrumbs\NovaBreadcrumbs;
use Anaseqal\NovaImport\NovaImport;
use Giuga\LaravelNovaSidebar\NovaSidebar;
use Giuga\LaravelNovaSidebar\SidebarGroup;
use Giuga\LaravelNovaSidebar\SidebarLink;
use Illuminate\Support\Facades\Gate;
use Illuminatech\NovaConfig\NovaConfig;
use Laravel\Nova\Cards\Help;
use Laravel\Nova\Nova;
use Laravel\Nova\NovaApplicationServiceProvider;
use Pktharindu\NovaPermissions\NovaPermissions;
use Nibri10\NovaGrid\NovaGrid;

class NovaServiceProvider extends NovaApplicationServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Nova::sortResourcesBy(function ($resource) {
            return $resource::$priority ?? 9999;
        });
        Nova::style('nova', public_path('css/nova.css'));
        parent::boot();
    }

    /**
     * Register the Nova routes.
     *
     * @return void
     */
    protected function routes()
    {
        Nova::routes()
            ->withAuthenticationRoutes()
            ->withPasswordResetRoutes()
            ->register();
    }

    /**
     * Register the Nova gate.
     *
     * This gate determines who can access Nova in non-local environments.
     *
     * @return void
     */
    protected function gate()
    {
        Gate::define('viewNova', function ($user) {
            return in_array($user->email, [
                //
            ]);
        });
    }

    /**
     * Get the cards that should be displayed on the default Nova dashboard.
     *
     * @return array
     */
    protected function cards()
    {
        return [

            new TotalCustomers(),
            new CustomersPerDay(),

        ];
    }

    /**
     * Get the extra dashboards that should be displayed on the Nova dashboard.
     *
     * @return array
     */
    protected function dashboards()
    {
        return [
            new SaleInsights()
        ];
    }

    /**
     * Get the tools that should be listed in the Nova sidebar.
     *
     * @return array
     */
    public function tools()
    {
        return [
            NovaBreadcrumbs::make(),
            new NovaGrid(),
            new NovaConfig(),
            new NovaImport(),
            \Pktharindu\NovaPermissions\NovaPermissions::make()
                ->roleResource(Role::class),
            (new NovaSidebar())
                ->addGroup((new SidebarGroup())
                    ->setName('Quick Links')
                    ->addLink((new SidebarLink())
                            ->setUrl(config('nova.path') . '/resources/inventories/new')
                            ->setType('_self')
                            ->setName('Add Inventory')
                    ))
        ];
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
