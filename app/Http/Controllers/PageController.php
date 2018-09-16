<?php

namespace App\Http\Controllers;

use App\Event;
use App\Insignia;
use App\Page;
use App\Scopes\CompanyScope;
use App\Ticket;
use DB;
use Illuminate\Http\Request;
use Auth;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Page $page)
    {
        return $page;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Event $event)
    {
        $page = new Page;
        if ($event->page){
            return redirect("page/".$event->page->id."/edit") ;
        }else{
            return view('page.create',compact('page','event'));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'background' => 'required',
        ]);
        if ($page = Page::create($request->all() + ['company_id' => Auth::user()->company_id])){
            if ($request->ajax()){
                return response()->json([
                    'status' => true,
                    'url' => url(route('event.page',[$page->event->id,$page->id]))
                ]);
            }
            session()->flash('message',"Pagina creada");
            return redirect('events');
        }else{
            session()->flash('message',"Error al crear la pagina");
            return redirect('events');
        }



    }

    /**
     * Display the specified resource.
     *
     * Establecemos conexion con la base de datos correspondiente.
     *
     * @param Request $request
     * @param $key
     * @param $page
     * @return \Illuminate\Http\Response
     */
    public function show($event_id,Page $page)
    {
        if ($page->is_live == 1){
            $event = Event::withoutGlobalScope(CompanyScope::class)->find($event_id);
            return view('page.show',compact('page','event'));
        }
        return abort(404);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if ($page = Page::find($id)){
            $event = $page->event;
            return view('page.edit',compact('page','event'));

        }else{
            return redirect("page/$id/create");
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'background' => 'required',
        ]);
        $page = Page::find($id);
        $page->fill($request->all());
        $page->is_live = ($request->is_live == 'on') ? '1' : '0';
        if ($page->update()){
            if ($request->ajax()){
                return response()->json([
                    'status' => true,
                    'url' => url(route('event.page',[$page->event->id,$page->id]))
                ]);
            }
            session()->flash('message',"Pagina Actualizada");
            return redirect("events/$page->event_id");
        }else{
            session()->flash('message',"Error al actualizar la pagina");
            return redirect('events');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
