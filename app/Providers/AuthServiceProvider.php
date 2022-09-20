<?php

namespace App\Providers;

use App\Policies\OrderPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Pktharindu\NovaPermissions\Traits\ValidatesPermissions;
use Illuminate\Support\Facades\Gate;
use App\Nova\User;

class AuthServiceProvider extends ServiceProvider
{
    use ValidatesPermissions;
    
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
        // Order::class => OrderPolicy::class,
        \Pktharindu\NovaPermissions\Role::class => \App\Policies\RolePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        foreach (config('nova-permissions.permissions') as $key => $permissions) {
            Gate::define($key, function (User $user) use ($key) {
                if ($this->nobodyHasAccess($key)) {
                    return true;
                }

                return $user->hasPermissionTo($key);
            });
        }
    }
}
