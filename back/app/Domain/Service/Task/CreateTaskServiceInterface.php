<?php

namespace App\Domain\Service\Task;

use App\Domain\Dto\CreatedTaskResponseDto;

interface CreateTaskServiceInterface
{
    public function __invoke(array $taskData): CreatedTaskResponseDto;
}
