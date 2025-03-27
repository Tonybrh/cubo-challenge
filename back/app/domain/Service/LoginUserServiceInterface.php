<?php

namespace App\domain\Service;

use App\domain\dto\UserLoggedResponseDto;
use App\Http\Request\LoginUserPostRequest;

interface LoginUserServiceInterface
{
    public function __invoke(LoginUserPostRequest $request): UserLoggedResponseDto;
}
