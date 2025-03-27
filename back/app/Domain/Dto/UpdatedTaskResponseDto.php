<?php

namespace App\Domain\Dto;

class UpdatedTaskResponseDto
{
    public function __construct(
        public int $id,
        public string $title,
        public ?string $description,
        public int $status
    ) {
    }
}
