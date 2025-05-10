<?php

namespace App\Domain\Service\Task;

interface FindByIdServiceInterface
{
    public function __invoke(int $id): array;
}
