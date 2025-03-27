<?php

namespace App\Http\Action\User;

use App\Domain\Service\LoginUserServiceInterface;
use App\Http\Request\User\LoginUserPostRequest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class LoginUserPostAction
{
    public function __construct(
        private LoginUserServiceInterface $userService
    ) {
    }

    public function __invoke(LoginUserPostRequest $loginUserPostRequest): JsonResponse
    {
        return new JsonResponse(
            ($this->userService)($loginUserPostRequest),
            Response::HTTP_OK
        );
    }
}
