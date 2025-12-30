<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OverrideInstaller
{
    /**
     * Handle an incoming request.
     * 
     * This middleware overrides installer checks globally.
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Override installer settings in memory for this request
        if (!function_exists('is_app_installed_override')) {
            function is_app_installed_override() {
                return true;
            }
        }
        
        return $next($request);
    }
}