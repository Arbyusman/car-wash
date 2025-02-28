<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;

class CheckRole
{
    public function handle($request, Closure $next, ...$roles)
    {
        try {
            $user = JWTAuth::parseToken()->authenticate();

            if (in_array($user->role_id, $roles) || $user->role_id == 1) {
                return $next($request);
            }

            return response()->json([
                'metadata' => [
                    'message' => 'Forbidden',
                    'status' => 403,
                ],
            ], 403);
        } catch (\Exception $e) {
            return response()->json([
                'metadata' => [
                    'message' => 'Unauthorized',
                    'status' => 401,
                ],
            ], 401);
        }
    }
}
