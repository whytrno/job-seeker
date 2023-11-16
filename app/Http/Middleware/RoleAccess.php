<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleAccess
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check() || !in_array(auth()->user()->role_id, $roles)) {
            return response([
                'success' => false,
                'message' => 'Unauthorized',
                'data' => null,
            ], 403);
        }

        return $next($request);
    }
}
