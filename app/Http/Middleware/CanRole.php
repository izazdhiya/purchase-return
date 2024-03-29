<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CanRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $roles): Response
    {
        $userRole = $request->user()->role;

        $allowedRoles = explode('|', $roles);

        if (!in_array($userRole, $allowedRoles)) {
            abort(403);
        }

        return $next($request);
    }
}
