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
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy'
    ];

    public function isEstagiario(User $user)
    {
        return $user->userType->nome == 'Estagiario';
    }

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('opinion-subjects:connect', function ($user) {
            return !$this->isEstagiario($user);
        });

        Gate::define('opinion-subjects:create', function ($user) {
            return !$this->isEstagiario($user);
        });

        Gate::define('opinion-subjects:update', function ($user) {
            return !$this->isEstagiario($user);
        });

        Gate::define('opinions:create', function ($user) {
            return !$this->isEstagiario($user);
        });

        Gate::define('opinions:update', function ($user) {
            return !$this->isEstagiario($user);
        });
    }
}
