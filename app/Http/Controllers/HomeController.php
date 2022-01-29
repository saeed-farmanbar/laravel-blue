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
        unset($_COOKIE['_greenlight-2_3_session']);
        setcookie("_greenlight-2_3_session", "", -1);
        return back();
    }

        



}
