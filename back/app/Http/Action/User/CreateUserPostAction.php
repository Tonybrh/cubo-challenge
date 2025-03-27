<?php

namespace App\Http\Action\User;

use App\Domain\Service\CreateUserServiceInterface;
use App\Http\Request\CreateUserPostRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class CreateUserPostAction
{
    public function __construct(
        private CreateUserServiceInterface $userService
    ) {
    }

    public function __invoke(CreateUserPostRequest $request): JsonResponse
    {
        return new JsonResponse(
            ($this->userService)($request),
            Response::HTTP_CREATED
        );
    }
}
