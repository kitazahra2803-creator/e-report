<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminKabupatenMiddleware
{
    public function handle(Request $request, Closure $next): Response
    {
        // Cek apakah user sudah login dan role-nya admin_kabupaten
        if (Auth::check() && Auth::user()->role == 'admin_kabupaten') {
            return $next($request);
        }
        
        // Jika bukan admin kabupaten, redirect ke dashboard user biasa
        return redirect('/dashboard')->with('error', 'Anda tidak memiliki akses ke halaman Admin Kabupaten');
    }
}