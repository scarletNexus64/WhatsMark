<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class BypassValidation
{
    /**
     * Handle an incoming request.
     * 
     * This middleware bypasses the license validation check
     * to allow free usage of the application.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Always allow the request to continue
        // This effectively disables the license validation requirement
        return $next($request);
    }
}