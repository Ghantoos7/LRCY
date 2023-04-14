<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;


class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Check if the user is authenticated
        if (Auth::check()) {
            // Check if the user type is admin 
            if (Auth::user()->user_type_id == 1) {
                // User is an admin, allow the request to proceed
                return $next($request);
            }
        }

        // User is not an admin, eturn an error response
        return response()->json([
            'error' => 'You are not an admin'
        ]);
    }
}
