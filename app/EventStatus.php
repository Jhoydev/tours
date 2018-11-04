<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventStatus extends Model
{
    public function event(){
        return $this->hasOne(Event::class);
    }
}
