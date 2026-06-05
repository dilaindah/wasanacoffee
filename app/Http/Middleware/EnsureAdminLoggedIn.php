<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureAdminLoggedIn
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Jika tidak ada session login admin, tendang balik ke halaman login admin
        if (!session()->has('admin_logged_in')) {
            return redirect()->route('admin.login');
        }

        return $next($request);
    }
}