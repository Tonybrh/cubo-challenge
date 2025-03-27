<?php

namespace App\Infrastructure\Service\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\TaskByStatusServiceInterface;

readonly class TaskByStatusService implements TaskByStatusServiceInterface
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {
    }

    public function __invoke(int $status, int $user): array
    {
        return $this->taskRepository->getTaskByStatus($status, $user);
    }
}
