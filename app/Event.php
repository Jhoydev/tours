<?php

namespace App;

use App\Scopes\CompanyScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Event extends Model
{

    protected $fillable = ["id", "title", "description", "address","cp", "start_date", "end_date", "city_id", "state_id",'country_id',"flyer","company_id",
                            "event_type_id","post_order_display_message","pre_order_display_message","enable_offline_payments","offline_payment_instructions","memories_url", "created_by"];
    protected $dates    = ['deleted_at', "start_date", "end_date"];
    protected $casts    = ["start_date", "end_date"];

    protected static function boot()
    {
        parent::boot();
        if (Auth::guard('web')->check()) {
            static::addGlobalScope(new CompanyScope);
        }
    }

    /* Relationships */
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

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }

    public function page()
    {
        return $this->hasOne(Page::class)->where('is_live',1);
    }

    public function event_type()
    {
        return $this->belongsTo(EventType::class);
    }

    public function status()
    {
        return $this->belongsTo(EventStatus::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->where('order_status_id','<','5');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderDetailsByCustomer()
    {
        return $this->hasMany(OrderDetail::class)->where('customer_id','=',Auth::user()->id);
    }

    public function ordersPaid()
    {
        return $this->hasMany(Order::class)->where('order_status_id','=','1');
    }

    public function ordersPending()
    {
        return $this->hasMany(Order::class)->where('order_status_id','=','5');
    }

    /* Mutators */

    public function setStartDateAttribute($value)
    {
        return $this->attributes['start_date'] = Carbon::parse($value);
    }

    public function setEndDateAttribute($value)
    {
        return $this->attributes['end_date'] = Carbon::parse($value);
    }

    /* Scopes */

    function scopeTitle($query, $title)
    {
        if ($title) {
            $id_events = [];

            $events = Event::Select(DB::raw('title, id'))
                            ->having('title', 'LIKE', "%$title%")->get();

            foreach ($events as $event) {
                array_push($id_events, $event->id);
            }

            return $query->whereIn('id', $id_events);
        }

        return $query;
    }

    function scopeActive($query)
    {
        $query->with('company','page')->where('start_date','>=',NOW())->orderBy('start_date','ASC');
        return $query;
    }

    /* Methods */

    public static function lastEvents($num)
    {
        return Event::orderBy('created_at', 'DESC')->take($num)->get();
    }

}
