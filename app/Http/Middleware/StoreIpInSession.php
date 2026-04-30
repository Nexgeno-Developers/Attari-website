<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Session;


class StoreIpInSession
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // IP tracking handled elsewhere; keep existing behavior for now.
        $user_ip = '{ "ip": "none", "city": "none", "region": "none", "country": "none", "loc": "none", "postal": "none", "timezone": "none", "readme": "none" }';
        Session::put('user_ip', $user_ip);

        // Medium + source tracking (2-hour sliding expiry inside a 2.5-hour Laravel session)
        ensure_marketing_tracking($request);

        
        return $next($request);
    }

}
