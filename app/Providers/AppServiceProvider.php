<?php

namespace App\Providers;

use App\Data\Repositories\Users;
use App\Services\Authorization;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * @var Users
     */
    private $usersRepository;

    public function __construct()
    {
        $this->usersRepository = app(Users::class);
    }

    private function setUpMailMessagesPerMinute()
    {
        $throttleRate = config('mail.throttleToMessagesPerMin');
        if ($throttleRate) {
            $throttlerPlugin = new \Swift_Plugins_ThrottlerPlugin(
                $throttleRate,
                \Swift_Plugins_ThrottlerPlugin::MESSAGES_PER_MINUTE
            );
            \Mail::getSwiftMailer()->registerPlugin($throttlerPlugin);
        }
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->bootGates();

        $this->bootComposers();

        $this->setUpMailMessagesPerMinute();

        Paginator::useBootstrap();
    }

    private function bootComposers()
    {
        View::composer('*', function ($view) {
            $view->with(
                array_merge(['formDisabled' => false, 'isFilter' => false], $view->getData())
            );
        });
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

    private function bootGates()
    {
        Gate::define('use-app', function ($user = null) {
            if (config('auth.authorization.enabled')) {
                $permissions = $user
                    ? app(Authorization::class)->getUserPermissions($user->username)
                    : null;

                $this->usersRepository->updateCurrentUser($permissions);

                // If the user has any permissions in the system, it is allowed to use it.
                return $permissions->count() > 0;
            } else {
                return true;
            }
        });
    }
}
