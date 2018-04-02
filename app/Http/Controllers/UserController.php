<?php

namespace App\Http\Controllers;

use App\Company;
use App\User;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Auth::user()->isRole('insignia')){
            $users = User::all();
        }else{
            $users = User::where('company_id','=',Auth::user()->company->id)->get();
        }
        return view('user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (Auth::user()->can('user.create')){
            if (Auth::user()->isInsignia()){
                $companies = Company::orderBy('name', 'ASC')->pluck('name', 'id')->all();
                $roles = Role::all();
            }else{
                $companies = "";
                $roles = Role::whereNotIn('id',[1])->get();
            }
            $permissions = Permission::all();
            return view('user.create',compact('companies','roles','permissions'));
        }else{
            return redirect('/');
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
        $user = User::create(Input::all());
        if ($request->role_id){
            DB::table('role_user')->insert([
                'role_id' => $request->role_id,
                'user_id' => $user->id
            ]);
        }
        return redirect('/');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $user = User::find($id);
        $this->authorize('pass',$user->company);
        return view('user.show',compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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

    public function roles(){
        if (Auth::user()->isInsignia()){
            $roles = Role::all();
        }else{
            $roles = Role::whereNotIn('id',[1])->get();
        }
        return response()->json($roles->toArray());
    }

    public function permissions(){
        $permissions = Permission::all();
        return response()->json($permissions->toArray());
    }
}
