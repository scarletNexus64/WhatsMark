<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BypassInstallCheck
{
    /**
     * Handle an incoming request.
     * 
     * This middleware bypasses the installation check completely
     * to allow free usage of the application.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Always allow the request to continue
        // This effectively disables the installation requirement
        return $next($request);
    }
}