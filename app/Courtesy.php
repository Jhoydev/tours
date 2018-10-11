<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courtesy extends Model
{
    protected $fillable = ['name','description','event_id'];

    public function customers()
    {
        return $this->belongsToMany(Customer::class);
    }
    public function events()
    {
        return $this->belongsToMany(Event::class);
    }
}
