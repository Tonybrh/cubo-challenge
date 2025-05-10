<?php

namespace App\Http\Action\User;

use App\Domain\Service\LoginUserServiceInterface;
use App\Http\Request\User\LoginUserPostRequest;
use App\Http\Resource\LoginUserPostResource;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

readonly class LoginUserPostAction
{
    public function __construct(
        private LoginUserServiceInterface $userService
    ) {
    }

    public function __invoke(LoginUserPostRequest $loginUserPostRequest): LoginUserPostResource
    {
        return new LoginUserPostResource(($this->userService)($loginUserPostRequest));
    }
}
