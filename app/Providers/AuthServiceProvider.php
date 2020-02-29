<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\User' => 'App\Policies\UserPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */


    public function boot()
    {
        Gate::before(function ($user, $ability) {
            if ($user->status == "Admin") {
                return true;
            }
        });
        
        Gate::define('eAdmin', function($user){
            return $user->status == "Admin"; 
        });

        Gate::define('eUser', function($user){
            return $user->status == "Comum"; 
        });
    }
}
