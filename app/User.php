<?php

namespace App;

use App\Scopes\CompanyScope;
use Caffeinated\Shinobi\Facades\Shinobi;
use Caffeinated\Shinobi\Models\Permission;
use Caffeinated\Shinobi\Models\Role;
use Caffeinated\Shinobi\Traits\ShinobiTrait;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable,ShinobiTrait,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name','last_name','email','phone','company_id', 'password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected $dates = ['deleted_at'];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();
        static::addGlobalScope(new SoftDeletingScope);

        if (Auth::check() && Auth::user()->company_id > 1){
            static::addGlobalScope(new CompanyScope);
        }

    }

    public function setPasswordAttribute($password)
    {
        if(Hash::needsRehash($password))
            $password = Hash::make($password);

        $this->attributes['password'] = $password;
    }

    public function company()
    {
        return $this->belongsTo(Company::class);
    }


    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->last_name);
    }


    public static function obtenerRoles()
    {
        return Role::all();
    }

    public static function obtenerPermisos()
    {
        return Permission::all();
    }

    function scopeFullName($query, $name)
    {
        if ($name){
            $id_users = [];

            $users = User::Select(DB::raw('CONCAT_WS(" ",`first_name`,`last_name`) as `wholename`,id'))
                ->having('wholename', 'LIKE',"%$name%")->get();

            foreach ($users as $user){
                array_push($id_users,$user->id);
            }

            return $query->whereIn('id',$id_users);
        }

        return $query;

    }

    function scopeWithCompany($query,$id){
        if ($id){
            return $query->where('company_id',$id);
        }
        return $query;
    }
}
