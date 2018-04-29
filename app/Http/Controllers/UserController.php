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
        $users = User::with('roles')->with('company')->withCompany($request->company_id)->fullName($request->full_name)->orderBy('company_id','ASC')->orderBy('first_name','ASC')->paginate(10);

        $companies = [];

        if (Auth::user()->company_id == 1){
            $companies = Company::orderBy('id', 'ASC')->pluck('name', 'id')->all();
        }

        if ($request->ajax()){
            return view('user.partials.users',compact('users'));
        }

        return view('user.index',compact('users','companies'));
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
            $user = new User();
            return view('user.create',compact('user','companies','roles','permissions'));
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
        if (Auth::user()->can('user.create')){
            if (Auth::user()->isInsignia()){
                $companies = Company::orderBy('name', 'ASC')->pluck('name', 'id')->all();
                $roles = Role::with('user');
            }else{
                $companies = "";
                $roles = Role::select('id','name')->whereNotIn('id',[1])->get();
            }
            $permissions = Permission::all();
            if ($user = User::find($id)){
                return view('user.edit',compact('user','companies','roles','permissions'));
            }
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
            session()->flash('message',"Usuario actualizado con ID: $user->id actualizado");
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
        if ($user->delete()){
            session()->flash('message','Usuario eliminado correctamente');
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
