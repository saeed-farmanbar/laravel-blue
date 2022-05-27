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
        $address = "https://live.marlics.ir/b/user-info-api";

        if (isset($_COOKIE['_greenlight-2_3_session'])) {

            $cookie = ['Cookie' => "_greenlight-2_3_session=" . urlencode($_COOKIE['_greenlight-2_3_session'])];




            $res = Http::withOptions([
                'headers' => $cookie
            ])->get($address);

            $userData = $res->collect();
            if ($res->json() == null) {
                $userData = [];
            }
            // $room=\DB::table('rooms')->where("id",app("user")["room_id"])->first()


            app()->bind('user', function ($app) use ($userData) {
                return $userData;
            });

            app()->bind('authenticated', function ($app) use ($userData) {
                return count($userData) > 0 ? true : false;
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
