<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Company extends Model
{
    public function user(){
        return $this->hasOne(User::class);
    }
    public function events(){
        return $this->belongsToMany(Event::class)->using(CustomerEvent::class);
    }
    public function customers(){
        return $this->hasManyThrough(customer::class,Event::class)->wherePivot('company_id','=',1);
    }

    public function ownCustomers()
    {
        return DB::table('customers')
            ->join('customer_event','customers.id', '=', 'customer_event.customer_id')
            ->join('events',function ($join){
                $join->on('events.id', '=', 'customer_event.event_id')
                    ->where('company_id', '=', $this->id);
            })
            ->groupBy('customers.id')
            ->get();
    }
}
