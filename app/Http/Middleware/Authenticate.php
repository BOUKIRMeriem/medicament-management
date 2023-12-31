<?php

namespace App\Http\Middleware;
use App\Http\Middleware\Authenticate;


use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
{
    if (!$request->expectsJson() && !Auth::check()) {
        return route('login');
    }

    return null;
}

    
}
