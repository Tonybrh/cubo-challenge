<?php

namespace App\Domain\Service\Task;

use App\Domain\Dto\UpdatedTaskResponseDto;

interface EditTaskServiceInterface
{
    public function __invoke(array $taskData): UpdatedTaskResponseDto;
}
