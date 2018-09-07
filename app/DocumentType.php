<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Attendee;

class DocumentType extends Model
{
    protected $fillable = ['name'];
    
    public function attendee()
    {
        return $this->hasMany(Attendee::class);
    }
}
