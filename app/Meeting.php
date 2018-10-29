<?php

namespace App;

use App\Traits\DatesTranslator;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Meeting extends Model
{
    use DatesTranslator;

    protected $dates    = ['start_meeting','end_meeting'];
    protected $casts    = ['start_meeting','end_meeting'];

    /* Mutators */

    public function setStartMeetingAttribute($value)
    {
        return $this->attributes['start_meeting'] = Carbon::parse($value);
    }

    public function setEndMeetingAttribute($value)
    {
        return $this->attributes['end_meeting'] = Carbon::parse($value);
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
        return $this->hasOne(MeetingStatus::class,'id','meeting_status_id');
    }
}
