<?php

namespace App\Infrastructure\Repository;

use App\Domain\Models\Task;
use App\Domain\Repository\TaskRepositoryInterface;
use Illuminate\Pagination\LengthAwarePaginator;

class TaskRepository implements TaskRepositoryInterface
{
    public function save(array $taskData): Task
    {
        return Task::query()->create($taskData);
    }

    public function update(array $taskData): Task
    {
        $task = Task::query()->where('id', $taskData['id'])
            ->where('user_id', $taskData['user_id'])
            ->firstOrFail();

        $task->update($taskData);

        return $task;
    }

    public function deleteTaskAndComments(int $taskId): void
    {
        $task = Task::query()->findOrFail($taskId);
        $task->comments()->delete();

        $task->delete();
    }

    public function getTaskByStatus(int $status): LengthAwarePaginator
    {
        return Task::query()
            ->where('task_status_id', $status)
            ->orderBy('created_at', 'desc')
            ->paginate(15);
    }
}
