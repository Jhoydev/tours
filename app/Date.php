<?php

namespace App;

use App\Traits\DatesTranslator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Date extends Model
{
    use DatesTranslator;

    protected $dates    = ['start_date','end_date'];
    protected $casts    = ['start_date','end_date'];

    /* Mutators */

    public function setStartDateAttribute($value)
    {
        return $this->attributes['start_date'] = Carbon::parse($value);
    }

    public function setEndDateAttribute($value)
    {
        return $this->attributes['end_date'] = Carbon::parse($value);
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
