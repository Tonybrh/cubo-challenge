<?php

namespace App\domain\Exception;

class UnauthorizedException extends \DomainException
{
    const string MESSAGE = 'Login ou Senha está(ão) errado(s)';
    public function __construct()
    {
        parent::__construct(self::MESSAGE);
    }
}
