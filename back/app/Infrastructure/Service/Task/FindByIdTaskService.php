<?php

namespace App\Infrastructure\Service\Task;

use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\FindByIdServiceInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

readonly class FindByIdTaskService implements FindByIdServiceInterface
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {
    }

    public function __invoke(int $id): array
    {
        $task = $this->taskRepository->findById($id);

        if ($id <= 0) {
            throw new \InvalidArgumentException('Invalid task ID');
        }

        if(empty($task)){
            throw new NotFoundHttpException('Task not found');
        }

        return $task;
    }
}
