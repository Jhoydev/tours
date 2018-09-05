<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Attendee extends Model {
    
    Use SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'document_type', 'document', 'email',
        'phone', 'mobile', 'address', 'address2', 'city', 'state', 'zip_code',
        'country', 'profession', 'workplace', 'password', 'edited_by', 'created_by'
    ];
    protected $dates    = ["deleted_at", "created_at", "updated_at"];

    public function user() {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

}
