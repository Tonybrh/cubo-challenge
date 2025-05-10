<?php

namespace App\Infrastructure\Repository;

use App\Domain\Models\Comment;
use App\Domain\Repository\CommentRepositoryInterface;

class CommentRepository implements CommentRepositoryInterface
{
    public function save(array $commentData): Comment
    {
        return Comment::query()->create($commentData);
    }

    public function findByTaskId(int $taskId): array
    {
        return Comment::query()->where('task_id', $taskId)->get()->toArray();
    }
}
