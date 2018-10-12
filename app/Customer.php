<?php

namespace App;

use function foo\func;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\DocumentType;
use App\Country;
use App\State;
use App\City;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class Customer extends Authenticatable
{

    use Notifiable,
        SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'document_type_id', 'document', 'email',
        'phone', 'mobile', 'address', 'address2', 'city_id', 'state_id', 'zip_code',
        'country_id', 'profession', 'workplace', 'password', 'edited_by', 'created_by'
    ];
    protected $dates    = ["deleted_at", "created_at", "updated_at"];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password))
            $password = Hash::make($password);

        $this->attributes['password'] = $password;
    }

    /* Relationships */

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
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

    public function orders()
    {
        return $this->hasMany(Order::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderDetailsSpecial($type)
    {
        return OrderDetail::whereHas('ticket',function ($query) use ($type){
            return $query->where('type',$type);
        })->whereHas('order',function ($query){
            return $query->where('customer_id',$this->id);
        })->get();
    }

    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function edited_by()
    {
        return $this->hasOne(User::class, 'id', 'edited_by');
    }

    public function events()
    {
        return $this->belongsToMany(Event::class)->orderBy('start_date','DESC')->using(CustomerEvent::class);
    }

    public function eventsActive()
    {
        return $this::with('events.page');
    }
    /* Mutators */

    /* Accessors */

    public function getFullNameAttribute()
    {
        return ucfirst($this->first_name) . " " . ucfirst($this->last_name);
    }

    /* Scopes */

    function scopeFullName($query, $name)
    {
        if ($name) {
            $id_customers = [];

            $customers = Customer::Select(DB::raw('CONCAT_WS(" ",`first_name`,`last_name`) as `wholename`,id'))
                            ->having('wholename', 'LIKE', "%$name%")->get();

            foreach ($customers as $customer) {
                array_push($id_customers, $customer->id);
            }

            return $query->whereIn('id', $id_customers);
        }
        
        return $query;
    }

}
