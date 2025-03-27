<?php

namespace App\domain\Service;

use App\domain\dto\UserLoggedResponseDto;
use App\Http\Request\CreateUserPostRequest;

interface CreateUserServiceInterface
{
    public function __invoke(CreateUserPostRequest $request): UserLoggedResponseDto;
}
