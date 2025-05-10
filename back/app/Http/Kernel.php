<?php

namespace App\Http;

use Illuminate\Routing\Middleware\SubstituteBindings;
use Illuminate\Routing\Middleware\ThrottleRequests;

class Kernel
{
    protected $middlewareGroups = [
        'api' => [
            ThrottleRequests::class.':api',
            SubstituteBindings::class,
        ],
    ];
}
