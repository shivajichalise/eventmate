<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        // Check if the user has the "attendee" role
        if (!$user->hasRole('attendee')) {
            return redirect()->route('profile.edit')->with(
                'message',
                ['type' => 'error', 'message' => 'Please complete your profile to continue.'],
            );
        }
        return $next($request);
    }
}
