<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $connection = 'insignia';
    protected $table = 'insignias';

    public function user(){
        return $this->belongsTo(User::class);
    }
}
