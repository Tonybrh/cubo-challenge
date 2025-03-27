<?php

namespace App\Domain\Repository;

use App\Domain\Models\Task;
use Illuminate\Pagination\LengthAwarePaginator;

interface TaskRepositoryInterface
{
    public function save(array $taskData): Task;
    public function update(array $taskData): Task;
    public function deleteTaskAndComments(int $taskId): void;
    public function getTaskByStatus(int $status): LengthAwarePaginator;
}
