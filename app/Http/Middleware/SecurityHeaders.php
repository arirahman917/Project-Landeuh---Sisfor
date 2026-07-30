<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request and attach security headers.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function handle(Request $request, Closure $next): Response
    {
        /** @var Response $response */
        $response = $next($request);

        // Preventive Security Headers
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        $response->headers->set('Permissions-Policy', 'camera=(), microphone=(), geolocation=()');

        // Content Security Policy
        // Directives configured for app resources (Midtrans, Bunny Fonts, Iconify, Flatpickr, Vite, etc.)
        $csp = "default-src 'self'; " .
               "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://npmcdn.com https://code.iconify.design https://app.sandbox.midtrans.com https://app.midtrans.com; " .
               "style-src 'self' 'unsafe-inline' https://fonts.bunny.net https://cdn.jsdelivr.net; " .
               "font-src 'self' https://fonts.bunny.net data:; " .
               "img-src 'self' data: https: blob: placehold.co res.cloudinary.com; " .
               "connect-src 'self' https: wss:; " .
               "frame-src 'self' https://app.sandbox.midtrans.com https://app.midtrans.com https://www.google.com https://maps.google.com;";

        $response->headers->set('Content-Security-Policy', $csp);

        return $response;
    }
}
