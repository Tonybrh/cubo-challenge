<?php

namespace App\Domain\Dto;

class CreatedTaskResponseDto
{
    public function __construct(
        public string $title,
        public string $description,
        public int $status
    ) {
    }
}
