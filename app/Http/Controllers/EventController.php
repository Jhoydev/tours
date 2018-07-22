<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventType;
use Illuminate\Http\Request;

class EventController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $events = Event::paginate(20);
        return view('events.index',compact('events'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
        public function create()
    {
        $event = new Event;
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();

        return view('events.create',compact('event','event_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $event = Event::create($request->all());
        session()->flash('message',"Evento con ID: $event->id creado");
        return redirect('events');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show',compact('event'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('events.edit',compact('event','event_types'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $event->fill($request->all());
        if ($event->update()){
            session()->flash('message',"Evento con ID: $event->id actualizado");
        }
        return redirect('events');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        if ($event->delete()){
            session()->flash('message','Evento eliminado correctamente');
            return redirect('events');
        }
        session()->flash('message','No se ha podido eliminar el evento, por favor contacte con soporte');
        return redirect('events');
    }

    public function prices(Event $event)
    {   
        return view('events.prices',compact('event'));
    }
}
