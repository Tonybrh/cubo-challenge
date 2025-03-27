<?php

namespace App\Infrastructure\Service\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\GetTaskByUserServiceInterface;
use Illuminate\Http\Request;

readonly class GetTaskByUserGetService implements GetTaskByUserServiceInterface
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {
    }

    public function __invoke(int $user): array
    {
        return $this->taskRepository->getTaskByUser($user);
    }
}
