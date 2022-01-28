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
        $address = "https://meet.mohit.art/b/user-info-api";
        
        if(isset($_COOKIE['_greenlight-2_3_session'])){

            $cookie = ['Cookie' => "_greenlight-2_3_session=".urlencode($_COOKIE['_greenlight-2_3_session'])];



            
            $res = Http::withOptions([
                'headers' => $cookie
            ])->get($address);
            
            dd($res->json());
            // $userData=(json_decode($res,true)));


            app()->bind('user', function ($app) use ($res){
                return $res;
            });

            app()->bind('authenticated', function ($app) use ($res){
                return $res!=null?true:false;
            });
            // logger(app('authenticated'));

            return $next($request);
        }


        
        app()->bind('authenticated', function ($app) {
            return false;
        });


        return $next($request);
    }
}
