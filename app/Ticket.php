<?php

namespace App;

use Carbon\Carbon;
use DateTime;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Ticket extends Model
{
    protected $fillable = [
        'id','title','description','max_per_person','min_per_person',
        'quantity_available','quantity_sold','start_sale_date',
        'end_sale_date','is_paused','price','sales_volume','type',
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

    public function user()
    {
        return $this->hasOne(User::class,'id','created_by');
    }
    public function event()
    {
        return $this->belongsTo(Event::class);
    }
    public static function checkIncompleteTickets()
    {
        $date = new DateTime;
        $date->modify(config('app.order_time'));
        $control_date = $date->format('Y-m-d H:i:s');
        $details = OrderDetail::where('complete','=',false)->where('created_at','<=',$control_date)->get();
        $orders = [];
        foreach ($details as $detail){
            $detail->ticket->increment('quantity_available');
            array_push($orders,$detail->order_id);
            $detail->forceDelete();
        }
        if (count($orders)>0){
            DB::table('orders')->whereIn('id',$orders)->delete();
        }
    }
}


