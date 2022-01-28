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
        
        //your cookie
        // if(isset($_COOKIE['_greenlight-2_3_session'])){

            $cookie = ['Cookie' => "_greenlight-2_3_session=".$_COOKIE['_greenlight-2_3_session']];

            logger($cookie );
             $cookie = ['Cookie' => "_greenlight-2_3_session=RE7xX%2F2v4Fezf6TjdhHGjh40ytwbiMgf%2F%2FWAbTFE%2BAUzg0nWvyPvGuDOcDEFmqz%2BDOD1sVZk3v0wbgFP5NAyPPg2i9q3vqFWTrlxpbLEOXsuNA%2FcDoXtAWBJn28wrzWBy1lZMzT2hNt%2BAYA1V0uJYgYlrpEQ7ldHdS8%3D--rYSPX7cqiXmt1oE1--k2MK3zqp5EOzBM6QiO%2F5gw%3D%3D"];
             logger("second" );
             logger($cookie );

            
            //your request
            $res = Http::withOptions([
                'headers' => $cookie
            ])->get($address);
            
            // logger($_COOKIE['_greenlight-2_3_session']);
            // logger("res:".$res->json());
            // logger("res:".$res->body());
            logger("res:".$res);
            logger("condition:");
            logger(empty($res));


            app()->bind('user', function ($app) use ($res){
                return $res;
            });

            app()->bind('authenticated', function ($app) use ($res){
                return $res!=null?true:false;
            });
            // logger(app("authenticated"));
            die();

            return $next($request);
        // }

        die();

        
        app()->bind('authenticated', function ($app) {
            return false;
        });


        return $next($request);
    }
}
