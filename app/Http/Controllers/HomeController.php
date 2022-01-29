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
        \Cookie::forget('_greenlight-2_3_session');
        return back();
    }

        



}
