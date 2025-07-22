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
        // Check for session authentication
        $user = Auth::user();
        if ($user && $user->role === 1) {
            return $next($request);
        }
    
        // Check for Bearer token in API-style requests
        $authHeader = $request->header('Authorization');
        if ($authHeader && str_starts_with($authHeader, 'Bearer ')) {
            $token = substr($authHeader, 7); // Remove 'Bearer ' prefix
            try {
                $user = Auth::guard('sanctum')->user();
                if ($user && $user->role === 1) {
                    return $next($request);
                }
            } catch (\Exception $e) {
                // Token invalid or error occurred
            }
        }
    
        return response()->json(['message' => 'Unauthorized'], 401);
    }
}
