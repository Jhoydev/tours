<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    protected $fillable = ["id", "title", "description", "location", "start_date", "end_date", "location", "event_type_id","created_by"];
    protected $dates = ['deleted_at', 'start_date', "end_date"];
    protected $casts = ["start_date"];

    public function page(){
        return $this->hasOne(Page::class);
    }
    public function event_type(){
        return $this->belongsTo(EventType::class);
    }
	public function status(){
        return $this->belongsTo(EventStatus::class);
    }
    public function prices(){
        return $this->hasMany(EventPrice::class);
    }
    
}
