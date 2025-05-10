<?php

namespace App\Infrastructure\Service\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\DeleteTaskServiceInterface;

readonly class DeleteTaskService implements DeleteTaskServiceInterface
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {
    }

    public function __invoke(int $taskId): void
    {
        $this->taskRepository->deleteTaskAndComments($taskId);
    }
}
