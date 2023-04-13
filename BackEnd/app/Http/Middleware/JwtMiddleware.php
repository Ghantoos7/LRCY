<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tymon\JWTAuth\Facades\JWTAuth;
use Exception;

class JwtMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
{
    try {
        $token = JWTAuth::parseToken();
        $user = $token->authenticate();
    } catch (Exception $e) {
        return response()->json(['error' => 'Unauthorized']);
    }

    if (!$user) {
        return response()->json(['error' => 'Unauthorized']);
    }

    $request->user = $user;

    return $next($request);
}
}
