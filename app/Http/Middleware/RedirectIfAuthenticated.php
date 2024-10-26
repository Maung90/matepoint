<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        // Jika user sudah login, redirect ke halaman home
        if (Auth::check()) {
            return redirect('/home');
        }

        // Jika belum login, biarkan akses ke halaman landing-page
        return $next($request);
    }
}
