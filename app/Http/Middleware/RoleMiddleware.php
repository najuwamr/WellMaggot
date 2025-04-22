<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    // public function handle(Request $request, Closure $next, ...$roles)
    // {
    //     if (!Auth::check()) {
    //         return redirect('/login');
    //     }

    //     $users = Auth::user();

    //     // Pastikan relasi role dimuat
    //     $users->load('role');

    //     // Cek apakah nama role user termasuk yang diizinkan
    //     if (!in_array($user->role->nama ?? '', $roles)) {
    //         abort(403, 'Unauthorized action.');
    //     }

    //     return $next($request);
    // }
}
