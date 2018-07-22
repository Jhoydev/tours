<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventPrice extends Model
{
    public function event(){
        return $this->belongsTo(Event::class);
    }
    
}
