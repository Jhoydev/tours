<?php

namespace App\Http\Controllers;

use App\Courtesy;
use App\Event;
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
        return view('event.courtesy.index',compact('courtesies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courtesy = new Courtesy;
        return view('event.courtesy.create',compact('courtesy'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Courtesy::create($request->all());
        session()->flash('message','Tiquet de Cortesía creado');
        return redirect(route('event.courtesy.index'));
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
        return view('event.courtesy.show',compact('courtesy','customers'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Courtesy  $courtesy
     * @return \Illuminate\Http\Response
     */
    public function edit(Courtesy $courtesy)
    {
        return view('event.courtesy.edit',compact('courtesy'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Courtesy  $courtesy
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Courtesy $courtesy)
    {
        $courtesy->fill($request->all());
        $courtesy->update();
        session()->flash('message','Tiquet de Cortesía actualizado');
        return redirect(route('event.courtesy.index'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Courtesy  $courtesy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Courtesy $courtesy)
    {
        $courtesy->delete();
        session()->flash('message','Tiquet de Cortesía eliminado');
        return redirect(route('event.courtesy.index'));
    }
}
