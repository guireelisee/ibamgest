<?php

namespace App\Providers;

use App\Models\User;
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

        Gate::define('admin', function(User $user){
            return $user->role->name === 'Administrateur';
        });
        Gate::define('directeur', function(User $user){
            return $user->role->name === 'Directeur';
        });
        Gate::define('secretaire', function(User $user){
            return $user->role->name === 'Secretaire';
        });
        Gate::define('secretaire_permanent', function(User $user){
            return $user->role->name === 'Secretaire Permanent';
        });
        Gate::define('scolarite', function(User $user){
            return $user->role->name === 'Scolarité';
        });
        Gate::define('demandeur', function(User $user){
            return $user->role->name === 'Demandeur';
        });
    }
}
