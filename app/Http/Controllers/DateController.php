<?php

namespace App\Http\Controllers;

use App\Date;
use App\Event;
use App\Mail\DateNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Mail;

class DateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $date = New Date();
        $date->start_date = $request->start_date;
        $date->customer_id = $request->contact_id;
        $date->contact_id = $request->customer_id;
        $date->message = $request->message;
        $date->event_id = $event->id;
        $date->date_status_id = 2;
        $date->end_date = Carbon::parse($request->start_date)->addMinute(30);
        $date->save();
        session()->flash('message','Cita solicitada');
        return back();
        dd();
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
    public function update(Event $event,Date $date)
    {
        $date->date_status_id = 1;
        $date->update();
        Mail::to(['email'=>$date->customer->email])->send(new DateNotification($date,'accepted'));
        Mail::to(['email'=>$date->contact->email])->send(new DateNotification($date,'accepted_to'));
        session()->flash('message','Cita Aceptada');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event,Date $date)
    {
        $date->date_status_id = 3;
        $date->update();
        Mail::to(['email'=>$date->customer->email])->send(new DateNotification($date,'refuse'));
        Mail::to(['email'=>$date->contact->email])->send(new DateNotification($date,'refuse_to'));

        session()->flash('message','Cita Cancelada');
        return back();
    }
}
