<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Ticket extends Model
{
    protected $fillable = [
        'id','title','description','max_per_person','min_per_person',
        'quantity_available','quantity_sold','start_sale_date',
        'end_sale_date','is_paused','price','sales_volume',
        'event_id','edited_by','created_by'];

    protected $dates = ['deleted_at',"start_sale_date","end_sale_date"];
    protected $casts = ["start_sale_date","end_sale_date"];


    public function setStartSaleDateAttribute($value)
    {
        return $this->attributes['start_sale_date'] = Carbon::parse($value);
    }
    public function setEndSaleDateAttribute($value)
    {
        return $this->attributes['end_sale_date'] = Carbon::parse($value);
    }

    public function user(){
        return $this->hasOne(User::class,'id','created_by');
    }
    public function event(){
        //dd( $this->belongsTo(Event::class));
        return $this->belongsTo(Event::class);
    }

    /* Methods */
    public function decrementTickets($num = 0){

        if ($num){
            $this->decrement('quantity_available',$num);
        }
        return false;
    }
}


