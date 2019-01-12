<?php

namespace App\Http\Controllers\Admin;

use App\Event;
use App\EventType;
use App\Http\Controllers\Controller;
use App\Mail\CanceledEventNotification;
use App\Order;
use App\OrderDetail;
use App\Page;
use App\Ticket;
use Illuminate\Support\Facades\Mail;
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
        $events      = Event::whereNotIn('event_status_id', [5])->orderBy('title', 'ASC')->get();
        $event_types = EventType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        $event_form  = new Event();
        $page        = new Page();

        if ($request->ajax()) {
            return view('admin.events.partials.events', compact('events', 'event_types', 'event_form', 'page'));
        }
        return view('admin.events.index', compact('events', 'event_types', 'event_form', 'page'));
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
            $page             = new Page();
            $page->background = $request->background;
            //$page->text_color = $request->text_color;
            $page->event_id = $event->id;
            $page->save();
        }
        if ($request->hasFile('flyer')) {
            $flyer    = $request->file('flyer');
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
            return response()->json(['status' => true,
                                    ]);
        }
        return redirect(route('admin.events.edit',['event' => $event->id]));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function show(Event $event)
    {
        $attended        = OrderDetail::where('event_id', '=', $event->id)->where('customer_id', '!=', null)->count();
        $pending_tickets = OrderDetail::where('event_id', '=', $event->id)->where('customer_id', '=', null)->count();
        return view('admin.events.show', compact('event', 'attended', 'pending_tickets'));
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
        $event_form  = $event;
        return view('admin.events.edit.index', compact('event', 'event_types', 'event_form'));
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
        $request->validate(['title' => 'required']);

        $event->fill($request->all());

        if ($request->hasFile('flyer')) {
            $flyer    = $request->file('flyer');
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
            return response()->json(['status' => true,
                                    ]);
        }
        session()->flash('message', "Guardado Correctamente");
        return back();
    }

    public function confirmDelete(Event $event)
    {
        $orders = $event->ordersPaid;
        return view('admin.events.confirm-delete', compact('event', 'orders'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Event $event
     * @return \Illuminate\Http\Response
     */
    public function destroy(Event $event)
    {
        $orders             = $event->ordersPaid;
        $customerConfimated = [];

        if (count($orders) > 0) {

            /*avisar a los customers y al comprador de la orden*/
            foreach ($orders as $order) {
                if ($order->customer_id == null || !$order->customer->email) {
                    continue;
                }
                if ($order->payu_order_id || $order->transaction_id) {
                    // PAGO ONLINE, PARCE HAGA SU MAGIA AQUI
                }
                if (!in_array($order->customer_id, $customerConfimated)) {
                    $customerConfimated[] = $order->customer_id;
                    Mail::to(['email' => $order->customer->email])->send(new CanceledEventNotification($event));

                }
            }

            $detailsCustomer = $event->orderDetailsGroupBy('customer_id');
            if (count($detailsCustomer) > 0) {
                foreach ($detailsCustomer as $d) {
                    if ($d->customer_id == null || !$d->customer->email) {
                        continue;
                    }
                    if (!in_array($d->customer_id, $customerConfimated)) {
                        $customerConfimated[] = $d->customer_id;
                        Mail::to(['email' => $d->customer->email])->send(new CanceledEventNotification($event));
                    }
                }
            }

        }
        $event->delete();
        return redirect(route('admin.events.index'));

    }

    public function customers(Event $event)
    {
        $details = OrderDetail::With('customer')->whereHas('order', function ($qry) {
            $qry->where('order_status_id', 1);
        })->Where('event_id', '=', $event->id)->where('complete', '=', 1)->get();
        return view('admin.events.customers', compact('event', 'details'));
    }

    public function orders(Event $event)
    {
        $tickets = Ticket::where('event_id', $event->id)->orderBy('title', 'ASC')->pluck('title', 'id');
        $event   = Event::where('id', $event->id)->with(['orders.customer', 'orders.order_status'])->first();
        return view('admin.events.orders', compact('event', 'tickets', 'orders'));
    }


    public function details(Event $event, Order $order)
    {
        $details = OrderDetail::where('order_id', '=', $order->id)->where('event_id', '=', $event->id)->get();
        //dd($details);
        return view('admin.events.details', compact('event', 'order', 'details'));
    }

}
