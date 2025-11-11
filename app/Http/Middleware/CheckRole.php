<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @param  string  ...$roles
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) {
            return redirect()->route('login');
        }

        // Check if user has one of the required roles
        if (!in_array($request->user()->role, $roles)) {
            // Redirect to appropriate dashboard based on user role
            return match ($request->user()->role) {
                'admin' => redirect()->route('admin.dashboard'),
                'psikolog' => redirect()->route('psikolog.dashboard'),
                'pasien' => redirect()->route('dashboard'),
                default => redirect()->route('dashboard'),
            };
        }

        return $next($request);
    }
}
