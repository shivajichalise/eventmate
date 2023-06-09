<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Illuminate\Http\Request;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     */
    protected function redirectTo(Request $request): ?string
    {
        // if (!$request->expectsJson()) {
        //     if ($request->is('organizers') || $request->is('organizers/*')) {
        //         return route('organizers.login');
        //     }
        //     return route('login');
        // } else {
        //     return null;
        // }

        return $request->expectsJson() ? null : route('login');
    }
}
