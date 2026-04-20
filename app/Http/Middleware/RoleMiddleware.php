<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if (!auth()->check()) {
            return redirect()->route('login');
        }

        $userRole = auth()->user()->role;

        // support multiple role: role:admin,owner
        if (!in_array($userRole, $roles)) {
            abort(403, 'AKSES DITOLAK');
        }

        return $next($request);
    }
}