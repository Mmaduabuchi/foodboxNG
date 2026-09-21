<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SecurityHeaders
{
    public function handle(Request $request, Closure $next): Response
    {
        $response = $next($request);

        // Prevent browsers from MIME-sniffing responses
        $response->headers->set(
            'X-Content-Type-Options',
            'nosniff'
        );

        // Prevent your site from being embedded in frames
        $response->headers->set(
            'X-Frame-Options',
            'SAMEORIGIN'
        );

        // Control referrer information
        $response->headers->set(
            'Referrer-Policy',
            'strict-origin-when-cross-origin'
        );

        // Disable unnecessary browser features
        $response->headers->set(
            'Permissions-Policy',
            'camera=(), microphone=(), geolocation=()'
        );

        // Only enable this when your production site uses HTTPS.
        // if ($request->isSecure()) {
        //     $response->headers->set(
        //         'Strict-Transport-Security',
        //         'max-age=31536000; includeSubDomains'
        //     );
        // }

        return $response;
    }
}