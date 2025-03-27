<?php

namespace App\Infrastructure\Service\Comment;

use App\Domain\Repository\CommentRepositoryInterface;
use App\Domain\Service\Comment\CommentsByTaskServiceInterface;

readonly class CommentsByTaskService implements CommentsByTaskServiceInterface
{
    public function __construct(
        private CommentRepositoryInterface $commentRepository
    ) {
    }

    public function __invoke(int $taskId): array
    {
        return $this->commentRepository->findByTaskId($taskId);
    }
}
