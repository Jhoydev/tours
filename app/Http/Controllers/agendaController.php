<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Date;
use App\Event;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class agendaController extends Controller
{
    public function index(Event $event){
        $customers  = $event->customers();
        return view('portal.event.agenda',compact('customers','event'));
    }

    public function customer(Request $request, Event $event, Customer $customer)
    {
        $dates = Date::where('customer_id','=',$customer->id)
            ->where('event_id','=',$event->id)->where('date_status_id','!=','3')
            ->orWhere(function ($query) use ($customer,$event){
                $query->where('contact_id','=',$customer->id)
                    ->where('event_id','=',$event->id);
            })->where('date_status_id','!=','3')
            ->get();
        $res = [];
        if (count($dates)){
            foreach ($dates as $date){
                $name = $date->contact->full_name;
                $contact = $date->contact;
                // Ponemos la subfijo solcitada cuando es una cita pedida por nosotros
                if ($date->contact_id == $customer->id){
                    $name = $date->customer->full_name;
                    $contact = $date->customer;

                }
                $color = '#20a8d8';
                if ($date->date_status_id == 1) {
                    $color = '#4dbd74';
                }
                if ($date->date_status_id == 2) {
                    $color = 'gold';
                }

                if (Auth::user()->id != $date->customer_id && Auth::user()->id != $date->contact_id){
                    $color = 'gray';
                    $name = "ocupado";
                }

                $res[] = [
                    'id' => $date->id,
                    'title' => "$name",
                    'start' => $date->start_date->toDateTimeString(),
                    'end' => $date->end_date->toDateTimeString(),
                    'color' => $color,
                    'message' => $date->message,
                    'status' => $date->date_status_id,
                    'req' => url("portal/event/$event->id/date/$date->id"),
                    'contact_id' => $date->contact_id,
                    'contact' => $contact
                ];
            }
        }
        return response()->json($res);
    }

}