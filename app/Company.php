<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    public function users(){
        return $this->hasMany(User::class);
    }
    public function events(){
        return $this->hasMany(Event::class);
    }
    public function scopeCompanyName($query,$name){
        return $query->where('name','LIKE',"%$name%");
    }
}
