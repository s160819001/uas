<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        // Gate::define('delete-permission',function($user){
        //     return($user->sebagai=='superadmin');
        // });

        Gate::define('admin-permission',function($user){
            return($user->sebagai=='admin');
        });

        Gate::define('member-permission',function($user){
            return($user->sebagai=='member');
        });
    }
}
