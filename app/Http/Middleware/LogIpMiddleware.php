<?php

namespace App\Http\Middleware;

use App\Models\IPlog;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class LogIpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $client_ip = $request->ip();
        IPlog::create(['ip_address' => $client_ip]);

        return $next($request);
    }
}
