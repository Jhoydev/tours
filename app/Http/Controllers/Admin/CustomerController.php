<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Customer;
use App\Meeting;
use App\DocumentType;
use App\Event;
use App\EventType;
use App\Notifications\CreateCustomer;
use App\Order;
use App\OrderDetail;
use App\Page;
use Caffeinated\Shinobi\Models\Permission;
use Illuminate\Http\Request;
use App\Http\Requests\CustomerRequest;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $customers = Company::find(Auth::user()->company_id)->customers();

        if ($request->ajax()) {
            return view('admin.customers.partials.customers', compact('customers'));
        }

        return view('admin.customers.index', compact('customers','company'));
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
        return view('admin.customers.create', compact('customer', 'permissions', 'document_types'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CustomerRequest $request)
    {
        $request->validate([
            'email' => 'required|unique:customers|email'
        ]);
        $customer = Customer::create($request->all());
        if (Auth::guard('web')){
            $customer->notify(new CreateCustomer($customer,$request->email,$request->password));
        }
        session()->flash('message', "Asistente $customer->name creado");
        return redirect(route('admin.customer'));
    }

    /**
     * BLOQUEADO POR RUTA EN web.php
     *
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Customer $customer)
    {
        $document_types = DocumentType::orderBy('name', 'ASC')->pluck('name', 'id')->all();
        return view('admin.customers.edit', compact('customer', 'document_types'));
    }

    /**
     * BLOQUYEADO POR RUTA EN web.php
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(CustomerRequest $request, $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->fill($request->all());
        $customer->save();

        session()->flash('message', "La información del asistente: $customer->first_name $customer->last_name ha sido actualizada");
        if (Auth::guard('customer')->check()) {
            return redirect(route('portal'));
        }
        return redirect('customer');
    }

    /**
     * BLOQUEADO POR RUTA EN web.php
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

}
