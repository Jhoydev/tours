<?php

namespace App;

use Alexo\LaravelPayU\Payable;
use Alexo\LaravelPayU\Searchable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Order extends Model
{

    use Payable,
        Searchable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'reference', 'payu_order_id', 'transaction_id', 'customer_id', 'event_id', 'order_status_id'
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    public function event_active()
    {
        return $this->belongsTo(Event::class,'event_id')->where('start_date','>',now());
    }


    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }

    public function tickets()
    {
        return DB::table('order_details')->select(DB::raw('count(*) as ticket_count,ticket_id'))->where('order_id',$this->id)->groupBy('ticket_id')->get();
    }
}
