<?php

namespace App\Infrastructure\Service\Comment;

use App\Domain\Dto\CreatedCommentResponseDto;
use App\Domain\Repository\CommentRepositoryInterface;
use App\Domain\Service\Comment\CreateCommentServiceInterface;

readonly class CreateCommentService implements CreateCommentServiceInterface
{
    public function __construct(
      private CommentRepositoryInterface $commentRepository
    ) {
    }

    public function __invoke(array $commentData): CreatedCommentResponseDto
    {
        $comment = $this->commentRepository->save($commentData);


        return new CreatedCommentResponseDto(
            $comment->content,
            $comment->user_id,
            $comment->task_id
        );
    }
}
