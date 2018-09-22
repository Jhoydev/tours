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
        return $this->hasMany(Event::class);
    }
    public function customers(){
        return $this->hasManyThrough(customer::class,Event::class)->wherePivot('company_id','=',1);
    }

    public function ownCustomers()
    {
        return DB::table('customers')
            ->join('order_details','customers.id', '=', 'order_details.customer_id')
            ->join('orders',function ($join){
                $join->on('orders.id', '=', 'order_details.order_id')
                    ->where('orders.order_status_id', '<=', 4);
            })
            ->join('events',function ($join){
                $join->on('events.id', '=', 'order_details.event_id')
                    ->where('company_id', '=', $this->id);
            })
            ->groupBy('customers.id')
            ->get();
    }
}
