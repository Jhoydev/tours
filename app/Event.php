<?php

namespace App;

use App\Scopes\CompanyScope;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Event extends Model
{

    protected $fillable = ["id", "title", "description", "location", "start_date", "end_date", "location", "flyer", "event_type_id", "created_by"];
    protected $dates    = ['deleted_at', "start_date", "end_date"];
    protected $casts    = ["start_date", "end_date"];

    protected static function boot()
    {
        parent::boot();
        if (Auth::guard('web')->check()) {
            static::addGlobalScope(new CompanyScope);
        }
    }

    public function page()
    {
        return $this->hasOne(Page::class);
    }

    public function event_type()
    {
        return $this->belongsTo(EventType::class);
    }

    public function status()
    {
        return $this->belongsTo(EventStatus::class);
    }

    public function tickets()
    {
        return $this->hasMany(Ticket::class);
    }

    public static function lastEvents($num)
    {
        return Event::orderBy('created_at', 'DESC')->take($num)->get();
    }

    public function setStartDateAttribute($value)
    {
        return $this->attributes['start_date'] = Carbon::parse($value);
    }

    public function setEndDateAttribute($value)
    {
        return $this->attributes['end_date'] = Carbon::parse($value);
    }

    function scopeTitle($query, $title)
    {
        if ($title) {
            $id_events = [];

            $events = Event::Select(DB::raw('title, id'))
                            ->having('title', 'LIKE', "%$title%")->get();

            foreach ($events as $event) {
                array_push($id_events, $event->id);
            }

            return $query->whereIn('id', $id_events);
        }

        return $query;
    }

}
