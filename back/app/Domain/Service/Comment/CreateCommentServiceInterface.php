<?php

namespace App\Domain\Service\Comment;

use App\Domain\Dto\CreatedCommentResponseDto;

interface CreateCommentServiceInterface
{
    public function __invoke(array $commentData): CreatedCommentResponseDto;
}
