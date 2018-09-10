<?php

namespace App\Http\Controllers;

use App\Customer;
use App\DocumentType;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CustomerController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $customers = Customer::paginate(20);
        return view('customers.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $customer    = new Customer();

        $document_types = DocumentType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('customers.create', compact('customer', 'permissions', 'document_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $customer                   = new Customer();
        $customer->first_name       = $request->first_name;
        $customer->last_name        = $request->last_name;
        $customer->document_type_id = $request->document_type_id;
        $customer->document         = $request->document;
        $customer->email            = $request->email;
        $customer->phone            = $request->phone;
        $customer->mobile           = $request->mobile;
        $customer->address          = $request->address;
        $customer->address2         = $request->address2;
        $customer->country_id       = $request->country_id;
        $customer->state_id         = $request->state_id;
        $customer->city_id          = $request->city_id;
        $customer->zip_code         = $request->zip_code;
        $customer->profession       = $request->profession;
        $customer->workplace        = $request->workplace;
        $customer->password         = $request->password;
        $customer->edited_by        = null;
        $customer->created_by       = $request->created_by;

        $customer->save();
        session()->flash('message', "Asistente $customer->name creado");
        return redirect('customer');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Customer  $customer
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
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
        $customer = Customer::find($id);

        $document_types = DocumentType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('customers.edit', compact('customer', 'document_types'));
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
        $customer = Customer::find($id);
        $customer->fill($request->all());
        $customer->save();

        session()->flash('message', "La información del asistente: $customer->first_name $customer->last_name ha sido actualizada");
        return redirect('customer');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $customer = Customer::find($id);
        $customer->delete();
        session()->flash('message', "El asistente: $customer->first_name $customer->last_name ha sido eliminado correctamente");
        return redirect('customer');
    }

    public function portal()
    {
        return view('portal.home');
    }

}
