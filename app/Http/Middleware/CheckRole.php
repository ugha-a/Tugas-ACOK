<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    /**
     * Handle an incoming request.
     * Usage in route: ->middleware('role:admin') or 'role:admin,staff'
     */
    public function handle(Request $request, Closure $next, string $roles = null)
    {
        $user = $request->user();
        if (! $user) {
            abort(403);
        }

        if (! $roles) {
            return $next($request);
        }

        $allowed = array_map('trim', explode(',', $roles));

        if (! in_array($user->role, $allowed, true)) {
            abort(403);
        }

        return $next($request);
    }
}
