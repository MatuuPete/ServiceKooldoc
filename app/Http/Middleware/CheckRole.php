<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        if (!in_array($user->role, $roles)) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}