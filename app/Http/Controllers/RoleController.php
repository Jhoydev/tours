<?php

namespace App\Http\Controllers;


use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::all();
        return view('role.index',compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $permissions = Permission::all();
        $role = new Role();
        return view('role.create',compact('role','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $role = new Role();
        $role->name = $request->name;
        $role->slug = $request->slug;
        $role->description = $request->description;

        if ($role->save()){
            if ($request->permissions){
                $array_permissions = explode(',',$request->permissions);
                foreach ($array_permissions as $permission_id){
                    $role->assignPermission($permission_id);
                    $role->save();
                }
            }
        }
        session()->flash('message',"Rol $role->name creado");
        return redirect('role');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $role = Role::find($id);
        if ($role->special == "all-access"){
            return $role;
        }
        return $role->Permissions;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::find($id);
        $role_permissions = implode(";",$role->getPermissions());
        $permissions = Permission::all();
        return view('role.edit',compact('role','permissions','role_permissions'));
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
        $res = false;
        $role = Role::find($id);
        $role->fill($request->all());
        if ($role->update()){
            if ($request->permissions){
                $array_permissions = explode(',',$request->permissions);
                $role->revokeAllPermissions();
                foreach ($array_permissions as $permission_id){
                    $role->assignPermission($permission_id);
                    $role->save();
                }
            }
            $res = true;
        }
        if ($res){
            session()->flash('message',"La información del rol: $role->name ha sido actualizada");
            return redirect('role');
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
        $role = Role::find($id);
        $role->delete();
        session()->flash('message',"El rol $role->name ha sido eliminado correctamente");
        return redirect('role');
    }
}
