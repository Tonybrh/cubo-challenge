<?php

namespace App\Http\Action\Comment;

use App\Domain\Service\Comment\CommentsByTaskServiceInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class CommentsByTaskGetAction
{
    public function __construct(
        private CommentsByTaskServiceInterface $commentsByTaskService
    ) {
    }

    public function __invoke(int $taskId): JsonResponse
    {
        return new JsonResponse(($this->commentsByTaskService)($taskId), Response::HTTP_OK);
    }
}
