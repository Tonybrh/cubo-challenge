<?php

namespace App\Domain\Service;

use App\Domain\Dto\UserLoggedResponseDto;
use App\Http\Request\LoginUserPostRequest;

interface LoginUserServiceInterface
{
    public function __invoke(LoginUserPostRequest $request): UserLoggedResponseDto;
}
