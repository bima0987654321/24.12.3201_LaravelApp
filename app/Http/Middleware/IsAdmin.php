<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     * Double Protection Layer:
     * Layer 1: Cek apakah user sudah login (jika belum, redirect ke halaman login admin)
     * Layer 2: Cek apakah role user adalah 'admin' (jika bukan, return 403 Forbidden)
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Layer 1: Pastikan user sudah login (authenticated)
        // Jika belum login, redirect ke halaman login admin
        if (!auth()->check()) {
            return redirect()->route('admin.login');
        }

        // Layer 2: Periksa apakah role user adalah 'admin'
        // Jika bukan admin, kembalikan response 403 Forbidden
        if (auth()->user()->role !== 'admin') {
            return response()->json([
                'message' => 'Forbidden. Only administrators are allowed to access this resource.'
            ], 403);
        }

        return $next($request);
    }
}
