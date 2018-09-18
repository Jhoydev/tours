<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DymoController extends Controller
{

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function printCockade(Request $request)
    {
        
        $events = Event::lastEvents(5);
        return view('dymo.cockade', compact('customer'));
    }

}
