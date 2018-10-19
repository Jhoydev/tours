<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderDetail extends Model
{
    protected $fillable = ['customer_id','updated_at'];

    public function Customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function Ticket()
    {
        return $this->belongsTo(Ticket::class);
    }

    public function Order()
    {
        return $this->belongsTo(Order::class);
    }

    public function Event()
    {
        return $this->belongsTo(Event::class);
    }

    public static function Attendees($event_id)
    {
        return OrderDetail::with('customer')->where('event_id','=',$event_id)->groupBy('customer_id')->get();
    }

    public static function addDetail(Ticket $ticket,Order $order,$fields = [])
    {
        $order_detail = new OrderDetail();
        $order_detail->ticket_id = $ticket->id;
        $order_detail->order_id = $order->id;
        $order_detail->event_id = $order->event_id;
        $order_detail->available = 1;
        $order_detail->code = Str::uuid();
        $order_detail->price = $ticket->price;
        if (count($fields)){
            foreach ($fields as $key => $value){
                $order_detail->$key = $value;
            }
        }
        $order_detail->save();
    }

    public static function DetailsNull(Event $event, Customer $customer)
    {
       return count(DB::select("select * from `order_details` where order_id in  (select id from orders where customer_id = :customer_id and event_id = :event_id) and customer_id is null",['customer_id'=>$customer->id,'event_id'=>$event->id]));
    }
}
