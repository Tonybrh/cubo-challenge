<?php

namespace App\Providers;

use App\Domain\Repository\CommentRepositoryInterface;
use App\Domain\Service\Comment\CommentsByTaskServiceInterface;
use App\Domain\Service\Comment\CreateCommentServiceInterface;
use App\Infrastructure\Repository\CommentRepository;
use App\Infrastructure\Service\Comment\CommentsByTaskService;
use App\Infrastructure\Service\Comment\CreateCommentService;
use Illuminate\Support\ServiceProvider;

class CommentServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        $this->app->bind(
            CommentRepositoryInterface::class,
            CommentRepository::class
        );

        $this->app->bind(
            CreateCommentServiceInterface::class,
            CreateCommentService::class
        );

        $this->app->bind(
            CommentsByTaskServiceInterface::class,
            CommentsByTaskService::class
        );
    }
}
