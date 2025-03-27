<?php

namespace App\Http\Action\User;

use App\domain\Service\LoginUserServiceInterface;
use App\Http\Request\LoginUserPostRequest;
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
