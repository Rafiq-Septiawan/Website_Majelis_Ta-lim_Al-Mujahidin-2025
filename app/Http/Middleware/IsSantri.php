<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsSantri
{
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->role === 'santri') {
            return $next($request);
        }

        return redirect('/admin/dashboard')->with('error', 'Akses ditolak!');
    }
}