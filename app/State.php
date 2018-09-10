<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class State extends Model
{
    protected $table = 'states';
    
    protected $fillable = ['name', 'country_id'];

    public function city()
    {
        return $this->hasMany(City::class);
    }
    
    public function country() 
    {
        return $this->belongsTo(Country::class);
    }
    
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }

}
