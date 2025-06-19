<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;
use Illuminate\Auth\Middleware\Authenticate;
use App\Http\Middleware\RoleMiddleware;

class Kernel extends HttpKernel
{
    protected $routeMiddleware = [
        'auth' => Authenticate::class,
        'role' => RoleMiddleware::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
    ];
}
