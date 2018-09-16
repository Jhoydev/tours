<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function user(){
        return $this->hasOne(User::class);
    }
    public function event(){
        return $this->belongsTo(Event::class);
    }
}
