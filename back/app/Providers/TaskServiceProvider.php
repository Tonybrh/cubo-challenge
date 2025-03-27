<?php

namespace App\Providers;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\CreateTaskServiceInterface;
use App\Infrastructure\Repository\TaskRepository;
use App\Infrastructure\service\Task\CreateTaskService;
use Illuminate\Support\ServiceProvider;

class TaskServiceProvider extends ServiceProvider
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
            CreateTaskServiceInterface::class,
            CreateTaskService::class
        );

        $this->app->bind(
            TaskRepositoryInterface::class,
            TaskRepository::class
        );
    }
}
