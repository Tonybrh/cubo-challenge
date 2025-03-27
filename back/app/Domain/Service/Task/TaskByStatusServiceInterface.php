<?php

namespace App\Domain\Service\Task;

interface TaskByStatusServiceInterface
{
    public function __invoke(int $status, int $user): array;
}
