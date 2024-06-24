<?php

namespace App\Http\Middleware;

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
        $allowed_ips = [
            '123.123.123.123',
            '124.124.124.124',
        ];

        $client_ip = $request->ip();

        if (in_array($client_ip, $allowed_ips)) {
            return $next($request);
        }

        return response()->json(['error' => 'Unauthorized IP address.'], 403);
    }
}
