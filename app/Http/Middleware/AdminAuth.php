<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        // Extract the Bearer token from the Authorization header
        $authHeader = $request->header('Authorization');
        if (!$authHeader || !str_starts_with($authHeader, 'Bearer ')) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $token = substr($authHeader, 7); // Remove 'Bearer ' prefix

        try {
            // Decode and validate the token using Laravel Sanctum
            $user = Auth::guard('sanctum')->user();

            if (!$user || $user->role !== 1) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            // Optionally log the username for debugging
            \Log::info('Admin Authenticated:', ['username' => $user->username]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
