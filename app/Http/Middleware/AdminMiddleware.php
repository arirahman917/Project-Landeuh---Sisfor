<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Cek apakah admin sudah login via session.
     * Jika belum → redirect ke halaman login.
     * Session timeout diatur 30 menit di config/session.php.
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('admin_logged_in')) {
            // Jika request AJAX/JSON, beri 401
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthorized'], 401);
            }

            return redirect()
                ->route('admin.login')
                ->with('error', 'Silakan login terlebih dahulu.');
        }

        return $next($request);
    }
}
