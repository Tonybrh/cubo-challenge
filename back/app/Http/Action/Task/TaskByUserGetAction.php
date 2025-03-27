<?php

namespace App\Http\Action\Task;

use App\Domain\Service\Task\GetTaskByUserServiceInterface;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class TaskByUserGetAction
{
    public function __construct(
        private GetTaskByUserServiceInterface $getTaskByUserService
    ) {
    }

    public function __invoke(Request $request): JsonResponse
    {
        return new JsonResponse(
            ($this->getTaskByUserService)($request->user()->id),
            Response::HTTP_OK
        );
    }
}
