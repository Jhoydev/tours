<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Date;
use App\Event;
use App\Mail\DateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class MeetingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $customers = $event->customers();
        return view('portal.event.agenda', compact('customers', 'event'));
    }

    public function customer(Request $request, Event $event, Customer $customer)
    {
        $dates = Date::where('customer_id', '=', $customer->id)
                ->where('event_id', '=', $event->id)->where('date_status_id', '!=', '3')
                ->orWhere(function ($query) use ($customer, $event) {
                    $query->where('contact_id', '=', $customer->id)
                    ->where('event_id', '=', $event->id);
                })->where('date_status_id', '!=', '3')
                ->get();
        $res = [];
        if (count($dates)) {
            foreach ($dates as $date) {
                if ($date->date_status_id == 2 && (Auth::user()->id != $date->customer_id && Auth::user()->id != $date->contact_id))
                    continue;
                $name    = $date->contact->full_name;
                $contact = $date->contact;
                // Ponemos la subfijo solcitada cuando es una cita pedida por nosotros
                if ($date->contact_id == $customer->id) {
                    $name    = $date->customer->full_name;
                    $contact = $date->customer;
                }
                $color = '#20a8d8';
                if ($date->date_status_id == 1) {
                    $color = '#4dbd74';
                }
                if ($date->date_status_id == 2) {
                    $color = 'gold';
                }

                if (Auth::user()->id != $date->customer_id && Auth::user()->id != $date->contact_id) {
                    $color = 'gray';
                    $name  = "ocupado";
                }

                $res[] = [
                    'id'         => $date->id,
                    'title'      => "$name",
                    'start'      => $date->start_date->toDateTimeString(),
                    'end'        => $date->end_date->toDateTimeString(),
                    'color'      => $color,
                    'message'    => $date->message,
                    'status'     => $date->date_status_id,
                    'req'        => url("portal/event/$event->id/date/$date->id"),
                    'contact_id' => $date->contact_id,
                    'contact'    => $contact
                ];
            }
        }
        return response()->json($res);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Event $event)
    {
        $date                 = New Date();
        $date->start_date     = $request->start_date;
        $date->customer_id    = $request->customer_id;
        $date->contact_id     = $request->contact_id;
        $date->message        = $request->message;
        $date->event_id       = $event->id;
        $date->date_status_id = 2;
        $date->end_date       = Carbon::parse($request->start_date)->addMinute(30);
        $date->save();
        session()->flash('message', 'Cita solicitada');
        Mail::to(['email' => $date->customer->email])->send(new DateNotification($date, 'request'));
        Mail::to(['email' => $date->contact->email])->send(new DateNotification($date, 'request'));
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Event $event, Date $date)
    {
        $date->date_status_id = 1;
        $date->update();
        Mail::to(['email' => $date->customer->email])->send(new DateNotification($date, 'accepted'));
        Mail::to(['email' => $date->contact->email])->send(new DateNotification($date, 'accepted'));
        session()->flash('message', 'Cita Aceptada');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Date $date)
    {
        $date->date_status_id = 3;
        $date->update();
        Mail::to(['email' => $date->customer->email])->send(new DateNotification($date, 'refuse'));
        Mail::to(['email' => $date->contact->email])->send(new DateNotification($date, 'refuse'));

        session()->flash('message', 'Cita Cancelada');
        return back();
    }

}
