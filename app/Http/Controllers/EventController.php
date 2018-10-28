<?php

namespace App\Http\Controllers;

use App\Event;
use App\EventType;
use App\Order;
use App\OrderDetail;
use App\Page;
use App\Ticket;
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
        if (Auth::guard('customer')->check()) {
            $events = Event::active()->paginate(20);
            return view('portal.events', compact('events'));
        }
        $events = Event::title($request->title)->orderBy('title', 'ASC')->paginate(20);
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $event_form = new Event();
        $page = new Page();

        if ($request->ajax()) {
            return view('events.partials.events', compact('events', 'event_types', 'event_form', 'page'));
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

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->request->add(['company_id' => $request->user()->company_id]);
        $event = Event::create($request->all());
        if ($request->background || $request->text_color) {
            $page = new Page();
            $page->background = $request->background;
            //$page->text_color = $request->text_color;
            $page->event_id = $event->id;
            $page->save();
        }
        if ($request->hasFile('flyer')) {
            $flyer = $request->file('flyer');
            $filename = "flyer." . $flyer->getClientOriginalExtension();

            $path_flyer = "companies/" . Auth::user()->company_id . "/events/$event->id/flyer";
            if (!Storage::disk('local')->exists($path_flyer)) {
                Storage::makeDirectory($path_flyer);
            }
            Image::make($flyer)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/" . $path_flyer) . "/$filename");
            $event->flyer = $path_flyer . "/" . $filename;
            $event->update();
        }
        if ($request->ajax()) {
            return response()->json([
                'status' => true,
            ]);
        }
        return redirect("events/$event->id");
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $attended = OrderDetail::where('event_id','=',$event->id)->where('customer_id','!=',null)->count();
        $pending_tickets = OrderDetail::where('event_id','=',$event->id)->where('customer_id','=',null)->count();
        return view('events.show', compact('event','attended','pending_tickets'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function edit(Event $event)
    {
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $event_form = $event;
        return view('events.edit.index', compact('event', 'event_types', 'event_form'));
    }

    public function page(Event $event)
    {
        if ($page = Page::where("event_id", $event->id)->first()) {
            $page_form['method'] = "PUT";
            $page_form['url'] = url("page/$page->id");
        } else {
            $page = new Page();
            $page_form['method'] = "POST";
            $page_form['url'] = url("page");
        }
        return view('events.edit.page', compact('event', 'page', 'page_form'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Event $event)
    {
        $request->validate([
            'title' => 'required'
        ]);

        $event->fill($request->all());

        if ($request->hasFile('flyer')) {
            $flyer = $request->file('flyer');
            $filename = "flyer." . $flyer->getClientOriginalExtension();

            $path_flyer = "companies/" . Auth::user()->company_id . "/events/$event->id/flyer";
            if (!Storage::disk('local')->exists($path_flyer)) {
                Storage::makeDirectory($path_flyer);
            }
            Image::make($flyer)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/" . $path_flyer) . "/$filename");
            $event->flyer = $path_flyer . "/" . $filename;
        }
        $event->update();

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
        session()->flash('message',"Guardado Correctamente");
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event $event
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

    public function customers(Event $event)
    {
        $details = OrderDetail::With('customer')->Where('event_id','=',$event->id)->where('complete','=',1)->get();
        return view('events.customers', compact('event', 'details'));
    }

    public function orders(Event $event)
    {
        $tickets = Ticket::where('event_id',$event->id)->orderBy('title', 'ASC')->pluck('title', 'id');
        $event = Event::where('id',$event->id)->with(['orders.customer','orders.order_status'])->first();
        return view('events.orders', compact('event','tickets','orders'));
    }

    public function orderDescription(Event $event)
    {
        return view("events.edit.order",compact('event'));
    }

    public function details(Event $event, Order $order)
    {
        $details = OrderDetail::where('order_id', '=', $order->id)
            ->where('event_id', '=', $event->id)
            ->get();
        //dd($details);
        return view('events.details', compact('event', 'order', 'details'));
    }

    public function memoryAndCertificate(Event $event)
    {
        return view("events.edit.memory-certificate",compact('event'));
    }

    public function memoryAndCertificateUpdate(Request $request, Event $event)
    {
        $event->fill($request->all());
        $event->update();
        session()->flash('message',"Guardado Correctamente");
        return redirect("events/$event->id/edit");
    }

    public function orderDescriptionUpdate(Request $request, Event $event)
    {
        $event->fill($request->all());
        $event->enable_offline_payments = ($request->enable_offline_payments) ? 1 : 0;
        $event->update();
        session()->flash('message',"Guardado Correctamente");
        return back();
    }

    public function taxes(Event $event)
    {
        return view('events.edit.taxes',compact('event'));
    }

    public function taxesUpdate(Request $request, Event $event)
    {
        $event->fill($request->all());
        $event->update();
        session()->flash('message',"Guardado Correctamente");
        return back();
    }


}
