<?php

namespace App\Http\Middleware;

use App\Models\AllowedIp;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IpAddressMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $clientIp = $request->ip();
        if (!AllowedIp::where('ip_address', $clientIp)->exists()) {
            return response()->json(['message' => 'IP address not allowed'], 403);
        }

        return $next($request);
    }
}
