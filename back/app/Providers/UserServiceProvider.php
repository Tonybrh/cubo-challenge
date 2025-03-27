<?php

namespace App\Providers;

use App\Domain\Service\CreateUserServiceInterface;
use App\Domain\Service\LoginUserServiceInterface;
use App\Infrastructure\Service\User\CreateUserService;
use App\Infrastructure\Service\User\LoginUserService;
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
