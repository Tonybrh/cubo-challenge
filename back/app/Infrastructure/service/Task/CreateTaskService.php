<?php

namespace App\Infrastructure\service\Task;

use App\Domain\Dto\CreatedTaskResponseDto;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\CreateTaskServiceInterface;

class CreateTaskService implements CreateTaskServiceInterface
{
    public function __construct(
        private readonly TaskRepositoryInterface $taskRepository
    ) {
    }

    public function __invoke(array $taskData): CreatedTaskResponseDto
    {
        $task = $this->taskRepository->save($taskData);

        return new CreatedTaskResponseDto(
            $task->title,
            $task->description,
            $task->task_status_id,
        );
    }
}
