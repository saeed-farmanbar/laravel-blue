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



        if($lang=="en")
        \App::setLocale("en");

        if($lang=="fa_IR")
        \App::setLocale("fa");

        if($lang=="de_DE")
        \App::setLocale("de");



        if(!app("authenticated")){
            // return back();
            return  redirect()->away('https://meet.mohit.art');

        }

        // $user=\DB::table('users')->where("uid",app("user")["uid"])->update(["language",$lang]);
        $user=\App\Models\User::where("uid",app("user")["uid"])->firstOrFail();
        $user->language=$lang;
        $user->save();

        $room=\DB::table('rooms')->where("id",app("user")["room_id"])->first();

        logger("to user room");
        logger($room);

        return  redirect()->away('https://meet.mohit.art/b/'.$room->id);
        // return back();


    }



}
