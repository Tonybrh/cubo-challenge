<?php

namespace App\Domain\Service;

use App\Domain\Dto\UserLoggedResponseDto;
use App\Http\Request\CreateUserPostRequest;

interface CreateUserServiceInterface
{
    public function __invoke(CreateUserPostRequest $request): UserLoggedResponseDto;
}
