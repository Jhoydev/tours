<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventType;
use App\Page;
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
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $event_form = new Event();
        return view('events.index',compact('events','event_types','event_form'));
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
        return redirect("events/$event->id");
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
        $event_form = $event;
        if (!$page = Page::where("event_id",$event->id)->first()) {
            $page = new  Page();
        }
        return view('events.edit',compact('event','event_types','event_form','page'));
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
            session()->flash('message',"Evento $event->title actualizado");
        }
        return redirect("events/$event->id");
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
            session()->flash('message',"Evento $event->title eliminado correctamente");
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
