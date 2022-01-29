<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    //

    public function show()
    {
        $availableRooms= \DB::table('rooms')->where('deleted','false')->get();
        return view('info', [
            'rooms' => $availableRooms
        ]);
    }


    public function logout()
    {
        if (isset($_SERVER['HTTP_COOKIE'])) {
            $cookies = explode(';', $_SERVER['HTTP_COOKIE']);
            foreach($cookies as $cookie) {
                $parts = explode('=', $cookie);
                $name = trim($parts[0]);
                setcookie($name, '', time()-1000);
                setcookie($name, '', time()-1000, '/');
            }
        }
        


        return back();
    }

        

    public function setLang($lang)
    {
        if(!in_array($lang,["en","de_DE","fa_IR"]))
        return back();
        if(!app("authenticated")){
            return back();
        }

        // $user=\DB::table('users')->where("uid",app("user")["uid"])->update(["language",$lang]);
        $user=\App\Models\User::where("uid",app("user")["uid"])->firstOrFail();
        $user->language=$lang;
        $user->save();
        return back();


    }



}
