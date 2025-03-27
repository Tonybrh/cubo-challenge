<?php

namespace App\Infrastructure\Service\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\GetTaskByUserServiceInterface;

readonly class GetTaskByUserGetService implements GetTaskByUserServiceInterface
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {
    }

    public function __invoke(int $user): array
    {
        if ($user <= 0) {
            throw new \InvalidArgumentException('User ID must be positive');
        }

        return $this->taskRepository->getTaskByUser($user);
    }
}
