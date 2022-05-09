<?php

namespace App\Providers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array<class-string, class-string>
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('route-list-users', function (User $user) {
            return $user->hasAnyRoles(['admin','author','superAdmin']);
        });
       
        
        Gate::define('show-menu-list-users', function (User $user) {
            return $user->hasAnyRoles(['admin','author','superAdmin']);
        });

        Gate::define('edit-table-users', function (User $user) {
            return $user->hasAnyRoles(['admin','superAdmin']);
        });


        Gate::define('delete-table-users', function (User $user) {
            return $user->hasAnyRoles(['superAdmin']);
        });

        Gate::define('superAdmin', function (User $user) {
            return $user->isSuperAdmin();
        });
        
        
    }
}
