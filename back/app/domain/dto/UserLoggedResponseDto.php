<?php

namespace App\domain\dto;

class UserLoggedResponseDto
{
    public function __construct(
      public string $accessToken,
      public string $tokenType
    ) {
    }
}
