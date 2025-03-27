<?php

namespace App\Domain\Repository;

use App\Domain\Models\Task;

interface TaskRepositoryInterface
{
    public function save(array $taskData): Task;
    public function update(array $taskData): Task;
    public function deleteTaskAndComments(int $taskId): void;
    public function getTaskByStatus(int $status, int $user): array;
    public function getTaskByUser(int $user): array;
    public function findById(int $id): array;
}
