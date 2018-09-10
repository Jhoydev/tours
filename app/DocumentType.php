<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Customer;

class DocumentType extends Model
{
    protected $fillable = ['name'];
    
    public function customer()
    {
        return $this->hasMany(Customer::class);
    }
}
