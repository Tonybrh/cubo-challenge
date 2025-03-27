<?php

namespace App\Domain\Service\Comment;

interface CommentsByTaskServiceInterface
{
    public function __invoke(int $taskId): array;
}
