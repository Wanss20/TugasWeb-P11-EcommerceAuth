<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Cek role user yang login.
     * Cara pakai di route: ->middleware('role:admin') atau ->middleware('role:admin,editor')
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        $user = $request->user();

        // belum login
        if (! $user) {
            return redirect()->route('login');
        }

        // role user ga ada di daftar yang diizinkan
        if (! in_array($user->role, $roles)) {
            abort(403, 'Kamu tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
