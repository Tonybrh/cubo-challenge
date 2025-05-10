<?php

namespace App\Providers;

use App\Domain\Models\Task;
use App\Domain\Policies\TaskPolicy;
use Illuminate\Support\ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{

    protected $policies = [
        Task::class => TaskPolicy::class,
    ];

    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
