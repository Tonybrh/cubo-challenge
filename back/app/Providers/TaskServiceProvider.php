<?php

namespace App\Providers;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\CreateTaskServiceInterface;
use App\Domain\Service\Task\DeleteTaskServiceInterface;
use App\Domain\Service\Task\EditTaskServiceInterface;
use App\Domain\Service\Task\GetTaskByUserServiceInterface;
use App\Domain\Service\Task\TaskByStatusServiceInterface;
use App\Infrastructure\Repository\TaskRepository;
use App\Infrastructure\Service\Task\CreateTaskService;
use App\Infrastructure\Service\Task\DeleteTaskService;
use App\Infrastructure\Service\Task\EditTaskService;
use App\Infrastructure\Service\Task\GetTaskByUserGetService;
use App\Infrastructure\Service\Task\TaskByStatusService;
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

        $this->app->bind(
            EditTaskServiceInterface::class,
            EditTaskService::class
        );

        $this->app->bind(
            DeleteTaskServiceInterface::class,
            DeleteTaskService::class
        );

        $this->app->bind(
            TaskByStatusServiceInterface::class,
            TaskByStatusService::class
        );

        $this->app->bind(
            GetTaskByUserServiceInterface::class,
            GetTaskByUserGetService::class
        );
    }
}
