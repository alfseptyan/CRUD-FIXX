<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class InternalReviewer
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        // Jika pengguna bukan admin, arahkan kembali
        if (auth()->check() && auth()->user()->level !== 'internal_reviewer') {
            return redirect()->route('buku')->with('error', 'Anda tidak memiliki akses ke halaman ini.');
        }

        // Jika pengguna adalah admin, lanjutkan request
        return $next($request);
    }
}    