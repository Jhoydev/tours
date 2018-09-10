<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Country extends Model
{
    protected $table = 'countries';
    
    protected $fillable = ['name', 'abbreviation'];

    public function state()
    {
        return $this->hasMany(State::class);
    }
    
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
}
