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

    use Notifiable,
        ShinobiTrait,
        SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['first_name', 'last_name', 'email', 'phone', 'mobile',
        'address', 'address2', 'city_id', 'state_id', 'country_id', 'company_id',
        'password',];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];
    protected $dates  = ['deleted_at'];

    protected static function boot()
    {
        parent::boot();
        if (Auth::guard("web")->check()) {
            static::addGlobalScope(new CompanyScope);
        }
    }

    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password))
            $password = Hash::make($password);

        $this->attributes['password'] = $password;
    }

    public function company()
    {
        return $this->belongsTo(Company::class, 'company_id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->last_name);
    }

    public static function getRoles()
    {
        return Role::all();
    }

    function scopeFullName($query, $name)
    {
        if ($name) {
            $id_users = [];

            $users = User::Select(DB::raw('CONCAT_WS(" ",`first_name`,`last_name`) as `wholename`,id'))
                            ->having('wholename', 'LIKE', "%$name%")->get();

            foreach ($users as $user) {
                array_push($id_users, $user->id);
            }

            return $query->whereIn('id', $id_users);
        }

        return $query;
    }

    function scopeWithCompany($query, $id)
    {
        if ($id) {
            return $query->where('company_id', $id);
        }
        return $query;
    }

}
