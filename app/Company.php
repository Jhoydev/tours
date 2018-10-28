<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
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
        return Customer::with('orderDetails.ticket')->whereHas('orderDetails',function ($query){
            return $query->whereHas('event',function ($query){
                return $query->where('company_id',Auth::user()->company_id);
            });
        })->orWhere(function ($query){
            return $query->whereHas('orders',function ($query){
                return $query->whereHas('event',function ($query){
                    return $query->where('company_id',Auth::user()->company_id);
                });
            });
        })->get();
    }
}
