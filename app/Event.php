<?php

namespace App;

use App\Scopes\CompanyScope;
use App\Traits\DatesTranslator;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Event extends Model
{
    use DatesTranslator,SoftDeletes;

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
        // Eliminar en cascada
        static::deleting(function($event) {
            $event->orders()->delete();
            $event->orderDetails()->delete();
            $event->tickets()->delete();
        });
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
        return Customer::whereHas('orderDetails',function($query){
            return $query->where('event_id',$this->id);
        })->get();
    }

    public function page()
    {
        return $this->hasOne(Page::class)->where('is_live',1);
    }

    public function event_type()
    {
        return $this->belongsTo(EventType::class);
    }

    public function eventStatus()
    {
        return $this->belongsTo(EventStatus::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public function ticketsPage()
    {
        return $this->hasMany(Ticket::class)
            ->where('type','simple')
            ->where('start_sale_date','<',now())
            ->where('end_sale_date','>',now());
    }

    public function orders()
    {
        return $this->hasMany(Order::class)->where('order_status_id','<','5');
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function orderDetailsGroupBy($group)
    {
        return $this->hasMany(OrderDetail::class)->groupBy($group)->get();
    }

    public function orderDetailsByCustomer()
    {
        return $this->hasMany(OrderDetail::class)->where('customer_id','=',Auth::user()->id);
    }

    public function ordersPaid()
    {
        return $this->hasMany(Order::class)->where('order_status_id','=','1');
    }

    public function cancelOrders()
    {
        return $this->hasMany(Order::class)->where('order_status_id','=','1')->update(['order_status_id' => 3]);
    }

    public function ordersPending()
    {
        return $this->hasMany(Order::class)->where('order_status_id','=','5');
    }

    /* Mutators */
    public function setStartDateAttribute($value)
    {
        return  $this->attributes['start_date'] = Carbon::createFromFormat('d/m/Y H:i', $value);
    }

    public function setEndDateAttribute($value)
    {
        return  $this->attributes['end_date'] = Carbon::createFromFormat('d/m/Y H:i', $value);
    }

    /* Scopes */
    function scopeActive($query)
    {
        $query->with('company','page')->whereNotIn('event_status_id',[4,5])->where('start_date','>=',NOW())->orderBy('start_date','ASC');
        return $query;
    }

    /* Methods */
    public static function lastEvents($num)
    {
        return Event::orderBy('created_at', 'DESC')->take($num)->get();
    }

    public function isActive()
    {
        if ($this->start_date < now() && $this->end_date > now()){
            return true;
        }
        return false;
    }

}
