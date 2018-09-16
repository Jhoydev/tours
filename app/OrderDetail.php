<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDetail extends Model
{
    public function Customer()
    {
        return $this->belongsTo(Customer::class,'customer_id');
    }

    public function Ticket()
    {
        return $this->belongsTo(Ticket::class);
    }
}
