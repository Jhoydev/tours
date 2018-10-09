<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $dates    = ['date_start','date_end'];
    protected $casts    = ['date_start','date_end'];

    /* Mutators */

    public function setDateStartAttribute($value)
    {
        return $this->attributes['date_start'] = Carbon::parse($value);
    }

    public function setDateEndAttribute($value)
    {
        return $this->attributes['date_end'] = Carbon::parse($value);
    }
    public function Event()
    {
        return $this->belongsTo(Event::class);
    }
    public function Contact()
    {
        return $this->belongsTo(Customer::class,'contact_id','id');
    }
    public function Customer()
    {
        return $this->belongsTo(Customer::class,'customer_id','id');
    }
    public function Status()
    {
        return $this->hasOne(DateStatus::class,'id','date_status_id');
    }
}
