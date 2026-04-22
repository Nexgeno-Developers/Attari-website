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
        
        //------------------------------- Privious code ------------------------------------------------
        
        // $ipAddress = $request->ip();

        // if (!Session::has('user_ip')) {
        //     $user_ip = ip_info();
     
        //     $session_data = json_decode($user_ip, true);

        //     if (!isset($session_data["ip"])) {
                
        //         $user_ip = '{ "ip": "none", "city": "none", "region": "none", "country": "none", "loc": "none", "postal": "none", "timezone": "none", "readme": "none" }';
        //         Session::put('user_ip', $user_ip);
        //     } else {
        //         Session::put('user_ip', $user_ip);
        //     }
        // } else {
            
        //     $session_data = json_decode(session('user_ip'), true);
        //     if (!isset($session_data["ip"])) {
                
        //         $user_ip = '{ "ip": "none", "city": "none", "region": "none", "country": "none", "loc": "none", "postal": "none", "timezone": "none", "readme": "none" }';
        //         Session::put('user_ip', $user_ip);
        //     }
           
        // } 
        
        //------------------------------- Privious code ------------------------------------------------
        
        $user_ip = '{ "ip": "none", "city": "none", "region": "none", "country": "none", "loc": "none", "postal": "none", "timezone": "none", "readme": "none" }';
        Session::put('user_ip', $user_ip);


        // Store the previous URL and source in session if not from the same domain
        // $previousUrl = url()->previous(); // Get previous URL
        // $appUrl = env('APP_URL'); // Get the APP_URL from .env

        // // Parse the URLs to extract the domain (host)
        // $previousDomain = parse_url($previousUrl, PHP_URL_HOST);
        // $appDomain = parse_url($appUrl, PHP_URL_HOST);

        // // If the previous URL is not from the same domain as the APP_URL
        // if ($previousDomain !== $appDomain) {
        //     // Check if the session does not already have the 'source_url' and 'source'
        //     if (!Session::has('source_url') || !Session::has('source')) {
        //         // Store the previous URL and source (e.g., 'referrer')
        //         Session::put('source_url', $previousUrl, 180); // 180 minutes = 3 hours
        //         Session::put('source', $appDomain, 180); // Adjust the source as needed
        //     }
        // }
        // Store the previous URL and source in session if not from the same domain

        // Store Medium in session based on current URL and referrer
        if (!Session::has('medium') || is_medium_expired()) {
            $medium = resolve_medium_from_request($request);
            Session::put('medium', $medium);
        }

        // Sliding expiry: refresh on every request so active users keep the same medium.
        Session::put('medium_expires_at', time() + (15 * 60));

        
        return $next($request);
    }

}
