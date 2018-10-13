<?php

namespace App\Http\Controllers;

use App\Event;
use Illuminate\Http\Request;

class agendaController extends Controller
{
    public function index(Event $event){
        $customers  = $event->customers();
        return view('portal.event.agenda',compact('customers','event'));
    }

    public function customer(Event $event){

    }
}
