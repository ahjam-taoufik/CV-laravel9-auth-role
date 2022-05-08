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

        Gate::define('admin-author-users', function (User $user) {
            return $user->hasAnyRoles(['admin','author']);
        });
       
        Gate::define('edit-users', function (User $user) {
            return $user->isAdmin();
        });

        Gate::define('delete-users', function (User $user) {
            return $user->isAdmin();
        });
        
        
    }
}
