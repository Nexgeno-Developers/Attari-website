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
        if (!Session::has('medium') || $this->isMediumExpired()) {
            $currentUrl = strtolower($request->fullUrl());
            $medium = null;

            if (str_contains($currentUrl, 'gclid')) {
                $medium = 'GA';
            } elseif (str_contains($currentUrl, 'linkedin_organic')) {
                $medium = 'LO';
            } elseif (str_contains($currentUrl, 'youtube_organic')) {
                $medium = 'YO';
            } elseif (str_contains($currentUrl, 'facebook_organic')) {
                $medium = 'FO';
            } elseif (str_contains($currentUrl, 'fb_paid')) {
                $medium = 'FA';
            } elseif (str_contains($currentUrl, 'fbclid')) {
                $medium = 'FO';
            } elseif (str_contains($currentUrl, 'gmb_organic')) {
                $medium = 'GMB';
            } elseif (str_contains($currentUrl, 'wati_mktg')) {
                $medium = 'W';
            } elseif (str_contains($currentUrl, 'wa_channel')) {
                $medium = 'WC';
            } elseif (str_contains($currentUrl, 'sms_mktg')) {
                $medium = 'S';
            } elseif (str_contains($currentUrl, 'rcs_mktg')) {
                $medium = 'R';
            } elseif (str_contains($currentUrl, 'email_replied')) {
                $medium = 'E';
            } elseif (str_contains($currentUrl, 'sbenrolled')) {
                $medium = 'EM';
            } elseif (str_contains($currentUrl, 'insta_organic')) {
                $medium = 'IO';
            } elseif (str_contains($currentUrl, 'blog')) {
                $medium = 'B';
            } else {
                $referrerUrl = $request->headers->get('referer');
                $appDomain = parse_url(env('APP_URL'), PHP_URL_HOST);
                $referrerDomain = parse_url((string) $referrerUrl, PHP_URL_HOST);

                if (!empty($referrerDomain)) {
                    $referrerDomain = strtolower($referrerDomain);
                    $referrerDomain = preg_replace('/^www\./', '', $referrerDomain);

                    if (!empty($appDomain) && $referrerDomain === strtolower($appDomain)) {
                        $referrerDomain = null;
                    }
                }

                if (!empty($referrerDomain)) {
                    $medium = $this->rootDomainLabel($referrerDomain);
                }
            }

            if (empty($medium)) {
                $medium = 'Direct';
            }

            Session::put('medium', $medium);
            Session::put('medium_expires_at', time() + (30 * 60));
        }

        
        return $next($request);
    }

    private function rootDomainLabel(?string $host): ?string
    {
        if (empty($host)) {
            return null;
        }

        $host = strtolower($host);
        $parts = explode('.', $host);
        $count = count($parts);

        if ($count === 1) {
            return $parts[0];
        }

        $last = $parts[$count - 1];
        $secondLast = $parts[$count - 2];

        if (strlen($last) === 2 && strlen($secondLast) <= 3 && $count >= 3) {
            return $parts[$count - 3];
        }

        return $parts[$count - 2];
    }

    private function isMediumExpired(): bool
    {
        $expiresAt = Session::get('medium_expires_at');

        if (empty($expiresAt)) {
            return true;
        }

        return time() >= (int) $expiresAt;
    }
}
