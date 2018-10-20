<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Meeting;
use App\Event;
use App\Mail\MeetingNotification;
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
        $dates = Meeting::where('customer_id', '=', $customer->id)
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
        $meeting                    = New Meeting();
        $meeting->start_meeting     = $request->start_meeting;
        $meeting->customer_id       = $request->customer_id;
        $meeting->contact_id        = $request->contact_id;
        $meeting->message           = $request->message;
        $meeting->event_id          = $event->id;
        $meeting->meeting_status_id = 2;
        $meeting->end_meeting       = Carbon::parse($request->start_meeting)->addMinute(30);
        $meeting->save();
        session()->flash('message', 'Cita solicitada');
        Mail::to(['email' => $meeting->customer->email])->send(new MeetingNotification($meeting, 'request'));
        Mail::to(['email' => $meeting->contact->email])->send(new MeetingNotification($meeting, 'request'));
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
    public function update(Event $event, Meeting $meeting)
    {
        $meeting->date_status_id = 1;
        $meeting->update();
        Mail::to(['email' => $meeting->customer->email])->send(new MeetingNotification($meeting, 'accepted'));
        Mail::to(['email' => $meeting->contact->email])->send(new MeetingNotification($meeting, 'accepted'));
        session()->flash('message', 'Cita Aceptada');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Meeting $meeting)
    {
        $meeting->date_status_id = 3;
        $meeting->update();
        Mail::to(['email' => $meeting->customer->email])->send(new MeetingNotification($meeting, 'refuse'));
        Mail::to(['email' => $meeting->contact->email])->send(new MeetingNotification($meeting, 'refuse'));

        session()->flash('message', 'Cita Cancelada');
        return back();
    }

}
