<?php

namespace App;

use Alexo\LaravelPayU\Payable;
use Alexo\LaravelPayU\Searchable;
use Illuminate\Database\Eloquent\Model;

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

    public function order_status()
    {
        return $this->belongsTo(OrderStatus::class);
    }



}
