<?php

namespace App\Domain\Repository;

use App\Domain\Models\Task;

interface TaskRepositoryInterface
{
    public function save(array $taskData): Task;
    public function update(array $taskData): Task;
    public function deleteTaskAndComments(int $taskId): void;
}
