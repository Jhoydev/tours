<?php

namespace App\Http\Controllers;

use App\Attendee;
use App\DocumentType;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AttendeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendees = Attendee::paginate(20);
        return view('attendees.index',compact('attendees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $attendee    = new Attendee();
        
        $document_types = DocumentType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('attendees.create', compact('attendee', 'permissions', 'document_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request) 
    {
        $attendee                = new Attendee();
        $attendee->first_name    = $request->first_name;
        $attendee->last_name     = $request->last_name;
        $attendee->document_type_id = $request->document_type_id;
        $attendee->document      = $request->document;
        $attendee->email         = $request->email;
        $attendee->phone         = $request->phone;
        $attendee->mobile        = $request->mobile;
        $attendee->address       = $request->address;
        $attendee->address2      = $request->address2;
        $attendee->city          = $request->city;
        $attendee->state         = $request->state;
        $attendee->zip_code      = $request->zip_code;
        $attendee->country       = $request->country;
        $attendee->profession    = $request->profession;
        $attendee->workplace     = $request->workplace;
        $attendee->password      = $request->password;
        $attendee->edited_by     = null;
        $attendee->created_by    = $request->created_by;

        $attendee->save();
        session()->flash('message', "Asistente $attendee->name creado");
        return redirect('attendee');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Attendee  $attendee
     * @return \Illuminate\Http\Response
     */
    public function show(Attendee $attendee)
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
        $attendee = Attendee::find($id);

        $document_types = DocumentType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('attendees.edit', compact('attendee', 'document_types'));
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
        $attendee = Attendee::find($id);
        $attendee->fill($request->all());
        $attendee->save();

        session()->flash('message', "La información del asistente: $attendee->first_name $attendee->last_name ha sido actualizada");
        return redirect('attendee');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendee = Attendee::find($id);
        $attendee->delete();
        session()->flash('message',"El asistente: $attendee->first_name $attendee->last_name ha sido eliminado correctamente");
        return redirect('attendee');
    }
    public function portal()
    {
        return view('portal.home');
    }
}
