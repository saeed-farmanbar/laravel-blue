<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Cookie;
class AuthenticateGreenlight
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {

        // AuthenticateGreenlight
        $address = "https://meet.mohit.art/b//user-info-api";
        
        //your cookie
        logger(Cookie::get());
        logger(cookie('_greenlight-2_3_session'));
        $coockie = ['Cookie' => "_greenlight-2_3_session=".$request->cookie('_greenlight-2_3_session')];
        
        //your request
        $res = Http::withOptions([
            'headers' => $coockie
        ])->get($address);
        logger($res);

        return $next($request);
    }
}
