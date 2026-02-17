<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent clickjacking
        $response->headers->set('X-Frame-Options', 'SAMEORIGIN');
        
        // Prevent MIME type sniffing
        $response->headers->set('X-Content-Type-Options', 'nosniff');
        
        // Enable XSS protection
        $response->headers->set('X-XSS-Protection', '1; mode=block');
        
        // Referrer policy
        $response->headers->set('Referrer-Policy', 'strict-origin-when-cross-origin');
        
        // Content Security Policy
        $response->headers->set('Content-Security-Policy', 
            "default-src 'self'; " .
            "script-src 'self' 'unsafe-inline' 'unsafe-eval' https://cdn.jsdelivr.net https://code.jquery.com; " .
            "style-src 'self' 'unsafe-inline' https://cdn.jsdelivr.net https://fonts.googleapis.com; " .
            "font-src 'self' https://fonts.gstatic.com https://cdn.jsdelivr.net; " .
            "img-src 'self' data: https:; " .
            "connect-src 'self';"
        );
        
        // Permissions Policy (formerly Feature Policy)
        $response->headers->set('Permissions-Policy', 
            'geolocation=(), microphone=(), camera=()'
        );

        return $response;
    }
}
