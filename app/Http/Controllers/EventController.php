<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventType;
use App\Page;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class EventController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $events      = Event::title($request->title)->orderBy('title', 'ASC')->paginate(20);
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $event_form  = new Event();
        $page        = new Page();

        if ($request->ajax()) {
            return view('events.partials.events', compact('events', 'event_types', 'event_form', 'page'));
        }
        if (Auth::guard('customer')->check()){
            return view('portal.events', compact('events', 'event_types', 'event_form', 'page'));
        }
        return view('events.index', compact('events', 'event_types', 'event_form', 'page'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $event       = new Event;
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $page        = new Page();
        return view('events.create', compact('event', 'event_types', 'page'));
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
        if ($request->background || $request->text_color) {
            $page             = new Page();
            $page->background = $request->background;
            //$page->text_color = $request->text_color;
            $page->event_id   = $event->id;
            $page->save();
        }
        if ($request->hasFile('flyer')) {
            $flyer    = $request->file('flyer');
            $filename = "flyer." . $flyer->getClientOriginalExtension();

            $path_flyer = "companies/" . Auth::user()->company_id . "/events/$event->id/flyer";
            if (!Storage::disk('local')->exists($path_flyer)) {
                Storage::makeDirectory($path_flyer);
            }
            Image::make($flyer)->encode('jpg', 75)->resize(300, 300)->save(storage_path("app/" . $path_flyer) . "/$filename");
            $event->flyer = $filename;
            $event->update();
        }
        if ($request->ajax()) {
            return response()->json([
                        'status' => true,
            ]);
        }
        //return redirect("events/$event->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event  $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        return view('events.show', compact('event'));
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
        $event_form  = $event;
        if ($page        = Page::where("event_id", $event->id)->first()) {
            $page_form['method'] = "PUT";
            $page_form['url']    = url("page/$page->id");
        } else {
            $page                = new Page();
            $page_form['method'] = "POST";
            $page_form['url']    = url("page");
        }
        return view('events.edit', compact('event', 'event_types', 'event_form', 'page', 'page_form'));
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
        $request->validate([
            'title' => 'required'
        ]);
        $event->fill($request->all());

        if ($request->hasFile('flyer')) {
            $flyer    = $request->file('flyer');
            $filename = "flyer." . $flyer->getClientOriginalExtension();

            $path_flyer = "companies/" . Auth::user()->company_id . "/events/$event->id/flyer";
            if (!Storage::disk('local')->exists($path_flyer)) {
                Storage::makeDirectory($path_flyer);
            }
            Image::make($flyer)->encode('jpg', 75)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/" . $path_flyer) . "/$filename");
            $event->flyer = $path_flyer . "/" . $filename;
            $event->update();
        }
        if ($request->delete_flyer == "true") {
            if (Storage::disk()->exists($event->flyer)) {
                Storage::delete($event->flyer);
                $event->flyer = "";
                $event->update();
            }
        }
        if ($request->ajax()) {
            return response()->json([
                        'status' => true,
            ]);
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
        if ($event->delete()) {
            session()->flash('message', "Evento $event->title eliminado correctamente");
            return redirect('events');
        }
        session()->flash('message', 'No se ha podido eliminar el evento, por favor contacte con soporte');
        return redirect('events');
    }
}
