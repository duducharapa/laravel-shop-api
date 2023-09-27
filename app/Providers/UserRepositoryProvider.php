<?php

namespace App\Providers;

use App\Http\Repositories\UserRepository;
use Illuminate\Support\ServiceProvider;

class UserRepositoryProvider extends ServiceProvider
{
    /**
     * Register the user repository service.
     */
    public function register(): void
    {
        $this->app->bind('UserRepository', function ($app) {
            return new UserRepository();
        });
    }

    /**
     * Bootstrap the user repository service.
     */
    public function boot(): void
    {
        //
    }
}
