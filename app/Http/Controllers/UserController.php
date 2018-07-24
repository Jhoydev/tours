<?php

namespace App\Http\Controllers;

use App\Company;
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
        $users = User::with('roles')->fullName($request->full_name)->orderBy('first_name','ASC')->paginate(10);

        if ($request->ajax()){
            return view('user.partials.users',compact('users'));
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
        $companies = "";
        $roles = Role::all();
        $permissions = Permission::all();
        $user = new User();
        return view('user.create',compact('user','roles','permissions'));
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
            Image::make($avatar)->encode('jpg',75)->resize(300,300)->save(storage_path("app/" . $path_avatar) ."/$filename");
        }

        session()->flash('message',"Usuario con ID: $user->id creado");
        return redirect('user');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        return redirect('user');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        /*Revisar el rol del usuario que no se le pasa en la vista*/
        if ($user = User::find($id)){
            $companies = "";
            $roles = Role::select('id','name')->get();
            $permissions = Permission::all();
            return view('user.edit',compact('user','companies','roles','permissions'));
        }

        return redirect('/');
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

        $res = false;
        $user = User::find($id);
        $user->fill($request->all());
        if ($user->update()){

            if ($request->role_id){
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
            Image::make($avatar)->encode('jpg',75)->resize(300,300)->save(storage_path("app/" . $path_avatar) ."/$filename");
        }
        if ($res){
            session()->flash('message',"La información del usuario: $user->full_name ha sido actualizada");
            return redirect('user');
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
        $user = User::find($id);
        $user_to_delete = $user->full_name;
        if ($user->delete()){
            session()->flash('message',"El usuario $user_to_delete ha sido eliminado correctamente");
            return redirect('user');
        }
        session()->flash('message','No se ha podido eliminar el usuario, por favor contacte con soporte');
        return redirect('user');
    }

    public function getImageAvatar($company,$id)
    {
        if (Storage::disk()->exists("companies/$company/avatars/$id.jpg")){
            $file = Storage::disk()->get("companies/$company/avatars/$id.jpg");
            return new Response($file,200);
        }
        return Image::make(public_path('img/avatar_default.jpg'))->response();
    }
}
