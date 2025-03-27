<?php

namespace App\Providers;

use App\domain\Service\CreateUserServiceInterface;
use App\domain\Service\LoginUserServiceInterface;
use App\Infrastructure\service\User\CreateUserService;
use App\Infrastructure\service\User\LoginUserService;
use Illuminate\Support\ServiceProvider;

class UserServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        $this->app->bind(
            CreateUserServiceInterface::class,
            CreateUserService::class
        );

        $this->app->bind(
            LoginUserServiceInterface::class,
            LoginUserService::class
        );
    }
}
