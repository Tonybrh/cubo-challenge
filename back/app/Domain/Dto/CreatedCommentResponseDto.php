<?php

namespace App\Domain\Dto;

class CreatedCommentResponseDto
{
    public function __construct(
        public string $content,
        public string $author,
        public string $task_id,
        public string $created_at
    ) {
    }
}
