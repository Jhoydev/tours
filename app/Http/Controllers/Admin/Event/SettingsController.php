<?php

namespace App\Http\Controllers\Admin\Event;

use App\Event;
use App\Page;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{

    public function memoryAndCertificate(Event $event)
    {
        return view("events.edit.memory-certificate", compact('event'));
    }

    public function memoryAndCertificateUpdate(Request $request, Event $event)
    {
        $event->fill($request->all());
        $event->update();
        session()->flash('message', "Guardado Correctamente");
        return redirect("events/$event->id/edit");
    }

    public function orderDescription(Event $event)
    {
        return view("events.edit.order", compact('event'));
    }

    public function orderDescriptionUpdate(Request $request, Event $event)
    {
        $event->fill($request->all());
        $event->enable_offline_payments = ($request->enable_offline_payments) ? 1 : 0;
        $event->update();
        session()->flash('message', "Guardado Correctamente");
        return back();
    }

    public function taxes(Event $event)
    {
        return view('events.edit.taxes', compact('event'));
    }

    public function taxesUpdate(Request $request, Event $event)
    {
        $event->fill($request->all());
        $event->update();
        session()->flash('message', "Guardado Correctamente");
        return back();
    }

    public function page(Event $event)
    {
        if ($page = Page::where("event_id", $event->id)->first()) {
            $page_form['method'] = "PUT";
            $page_form['url']    = url("page/$page->id");
        } else {
            $page                = new Page();
            $page_form['method'] = "POST";
            $page_form['url']    = url("page");
        }
        return view('admin.events.edit.page', compact('event', 'page', 'page_form'));
    }
}
