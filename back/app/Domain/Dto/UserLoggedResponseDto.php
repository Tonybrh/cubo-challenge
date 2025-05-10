<?php

namespace App\Domain\Dto;

class UserLoggedResponseDto
{
    public function __construct(
      public string $accessToken,
      public string $tokenType
    ) {
    }
}
