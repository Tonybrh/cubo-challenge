<?php

namespace App\Domain\Repository;

use App\Domain\Models\Comment;

interface CommentRepositoryInterface
{
    public function save(array $commentData): Comment;
    public function findByTaskId(int $taskId): array;
}
