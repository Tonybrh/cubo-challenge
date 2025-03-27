<?php

namespace App\Infrastructure\Repository;

use App\Domain\Models\Task;
use App\Domain\Repository\TaskRepositoryInterface;

class TaskRepository implements TaskRepositoryInterface
{
    public function save(array $taskData): Task
    {
        return Task::query()->create($taskData);
    }
}
