<?php

namespace App\Domain\Repository;

use App\Domain\Dto\CreatedCommentResponseDto;

interface CreateCommentServiceInterface
{
    public function __invoke(array $commentData): CreatedCommentResponseDto;
}
