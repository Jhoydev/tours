<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Page extends Model
{
    protected $fillable = ['background','color_text','event_id','is_live','company_id'];

    public function event(){
        return $this->belongsTo(Event::class);
    }
    public static function publicView($database,$id){
        return DB::table("$database.pages")
            ->join("$database.events", 'pages.event_id', '=', 'events.id')
            ->join("$database.event_types", 'event_types.id', '=', 'events.event_type_id')
            ->where([['pages.id',$id],['pages.is_live',1]])
            ->select('pages.id as page_id','pages.background','pages.color_text', 'events.*', 'event_types.name as event_type_name')
            ->get()->first();
    }
}
