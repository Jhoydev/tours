<?php

namespace App\Http\Controllers;

use App\Courtesy;
use App\Customer;
use App\Event;
use App\OrderDetail;
use Illuminate\Http\Request;

class CourtesyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Event $event)
    {
        $courtesies = Courtesy::where('event_id','=',$event->id)->get();
        return view('events.courtesy.index',compact('courtesies','event'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $courtesy = new Courtesy;
        return view('events.courtesy.create',compact('courtesy','event'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Event $event, Request $request)
    {
        Courtesy::create($request->all());
        session()->flash('message','Tiquet de Cortesía creado');
        return redirect(url("events/$event->id/courtesy"));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Courtesy  $courtesy
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event, Courtesy $courtesy)
    {
        $customers = OrderDetail::Where('event_id','=',$event->id)->where('complete','=',1)->groupBy('customer_id')->get();
        return view('events.courtesy.show',compact('courtesy','customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Courtesy  $courtesy
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event, Courtesy $courtesy)
    {
        return view('events.courtesy.edit',compact('courtesy','event'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courtesy  $courtesy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event, Courtesy $courtesy)
    {
        $courtesy->fill($request->all());
        $courtesy->update();
        session()->flash('message','Tiquet de Cortesía actualizado');
        return redirect(url("events/$event->id/courtesy"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courtesy  $courtesy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event, Courtesy $courtesy)
    {
        $courtesy->delete();
        session()->flash('message','Tiquet de Cortesía eliminado');
        return redirect(url("events/$event->id/courtesy"));
    }

    public function assignToCustomer(Request $request, Event $event, Courtesy $courtesy,Customer $customer)
    {
        $courtesy->customers()->save($customer,['event_id' => $event->id,'created_at'=>now()]);
        $courtesy->decrement('quantity_available');
        $courtesy->update();
        return redirect(url("events/$event->id/courtesy/$courtesy->id"));
    }
}
