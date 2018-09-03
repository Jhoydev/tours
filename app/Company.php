<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'insignia';
    protected $table = 'clientes';

    public function user(){
        return $this->hasOne(User::class);
    }
}
