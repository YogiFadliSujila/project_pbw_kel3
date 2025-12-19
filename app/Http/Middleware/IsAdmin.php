<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect()->route('login');
        }

        if ($user->role !== 'admin') {
            // If request expects JSON (API/AJAX), return 403 JSON
            if ($request->expectsJson()) {
                abort(403, 'Access denied.');
            }

            // Redirect authenticated non-admin users to their profile
            // and set no-cache headers so browser Back/Refresh won't re-show the protected route.
            $response = redirect()->route('profile.edit')
                ->with('error', 'Akses ditolak: hanya admin yang dapat mengakses halaman ini.');

            $response->headers->set('Cache-Control', 'no-cache, no-store, must-revalidate');
            $response->headers->set('Pragma', 'no-cache');
            $response->headers->set('Expires', '0');

            return $response;
        }

        return $next($request);
    }
}
