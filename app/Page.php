<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    protected $fillable = ['background','color_text','event_id'];

    public function event(){
        return $this->belongsTo(Event::class);
    }

}
