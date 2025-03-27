<?php

namespace App\Providers;

use App\domain\Service\CreateUserServiceInterface;
use App\domain\Service\LoginUserServiceInterface;
use App\Infrastructure\service\User\CreateUserService;
use App\Infrastructure\service\User\LoginUserService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

    }
}
