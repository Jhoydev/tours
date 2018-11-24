<?php

namespace App\Http\Controllers\Admin;

use App\Company;
use App\Helpers\ImageStore\ImageStore;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\User;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $users = User::with('roles')->get();

        if ($request->ajax()){
            return view('user.partials.users',compact('users'));
        }

        return view('admin.user.index',compact('users'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $roles = Role::all();
        $permissions = Permission::all();
        $user = new User();
        return view('admin.user.create',compact('user','roles','permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(UserRequest $request)
    {
        
        $user = User::create($request->all());
        if ($request->role_id){
            DB::table('role_user')->insert([
                'role_id' => $request->role_id,
                'user_id' => $user->id
            ]);
        }
        if ($request->permissions_id){
            $array_permissions = explode(',',$request->permissions_id);
            foreach ($array_permissions as $permission_id){
                DB::table('permission_user')->insert([
                    'permission_id' => $permission_id,
                    'user_id' => $user->id
                ]);
            }
        }

        if ($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = $user->id . "." . $avatar->getClientOriginalExtension();

            $path_avatar = "companies/$user->company_id/avatars";
            if (!Storage::disk('local')->exists($path_avatar)){
                Storage::makeDirectory($path_avatar);
            }
            Image::make($avatar)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/" . $path_avatar) ."/$filename");
            $user->avatar = $filename;
            $user->update();
        }

        session()->flash('message',"Usuario creado");
        return redirect(route('admin.user.index'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        if (count($user->Roles) > 0){
            $user_role = $user->Roles->last()->id;
        }else{
            $user_role = '';
        }
        $companies = "";
        $roles = Role::select('id','name')->orderBy('id', 'asc')->get();
        $permissions = Permission::all();
        $url_avatar = url("user/avatar/".$user->company_id."/".$user->id);
        if (!Storage::disk()->exists("companies/$user->company_id/avatars/$user->id.jpg")){
            $url_avatar = "";
        }
        return view('admin.user.edit',compact('user','companies','roles','permissions','url_avatar','user_role'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $res = false;
        $user->fill($request->all());
        if ($user->update()){

            if ($request->role_id){
                $user->revokeAllRoles();
                $user->assignRole($request->role_id);
            }

            if ($request->permissions_id){
                $array_permissions = explode(',',$request->permissions_id);
                $user->permissions()->sync($array_permissions);
            }else{
                $user->permissions()->detach();
            }
            $res = true;
        }
        if ($request->hasFile('avatar')){
            $avatar = $request->file('avatar');
            $filename = $user->id . "." . $avatar->getClientOriginalExtension();

            $path_avatar = "companies/$user->company_id/avatars";
            if (!Storage::disk('local')->exists($path_avatar)){
                Storage::makeDirectory($path_avatar);
            }
            Image::make($avatar)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save(storage_path("app/" . $path_avatar) ."/$filename");
            $user->avatar = $filename;
            $user->update();
        }else{
            $delete_avatar = $request->delete_avatar;
            if ($delete_avatar == "true"){
                $avatar_url = "companies/$user->company_id/avatars/$user->id.jpg";
                if (Storage::disk()->exists($avatar_url)){
                    Storage::delete($avatar_url);
                    $user->avatar = "default.jpg";
                    $user->update();
                }

            }
        }
        if ($res){
            session()->flash('message',"La información del usuario: $user->full_name ha sido actualizada");
            return redirect(route('admin.user.index'));
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        $user_to_delete = $user->full_name;
        $avatar_url = "companies/$user->company_id/avatars/$user->avatar";
        if ($user->delete()){
            if (Storage::disk()->exists($avatar_url)){
                Storage::delete($avatar_url);
            }
            session()->flash('message',"El usuario $user_to_delete ha sido eliminado correctamente");
            return redirect( route('admin.user.index'));
        }
        session()->flash('message','No se ha podido eliminar el usuario, por favor contacte con soporte');
        return redirect(route('admin.user.index'));
    }

    public function getImageAvatar(Company $company, User $user)
    {
        $avatar = $user->avatar;
        $path = "companies/$company->id/avatars/$avatar";
        return ImageStore::getImage($path);
    }

    public function getPermissionsAndRoles(Request $request){
        $res = [];
        if ($request->user_id){
            $user = User::find($request->user_id);
            $permissions = $user->permissions;
            $res['user'] = $permissions->toArray();
        }
        if ($request->role_id){
            $role = Role::find($request->role_id);
            $res['role'] = $role->Permissions->toArray();

        }
        return response()->json($res);
    }
}
