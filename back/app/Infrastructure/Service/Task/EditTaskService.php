<?php

namespace App\Infrastructure\Service\Task;

use App\Domain\Dto\UpdatedTaskResponseDto;
use App\Domain\Repository\TaskRepositoryInterface;
use App\Domain\Service\Task\EditTaskServiceInterface;

readonly class EditTaskService implements EditTaskServiceInterface
{
    public function __construct(
        private TaskRepositoryInterface $taskRepository
    ) {
    }

    public function __invoke(array $taskData): UpdatedTaskResponseDto
    {
       $task = $this->taskRepository->update($taskData);

        return new UpdatedTaskResponseDto(
            $task->id,
            $task->title,
            $task->description,
            $task->task_status_id
        );
    }
}
