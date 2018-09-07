<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\DocumentType;
use App\User;

class Attendee extends Model {

    Use SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'document_type_id', 'document', 'email',
        'phone', 'mobile', 'address', 'address2', 'city', 'state', 'zip_code',
        'country', 'profession', 'workplace', 'password', 'edited_by', 'created_by'
    ];
    protected $dates    = ["deleted_at", "created_at", "updated_at"];

    public function document_type() {
        return $this->belongsTo(DocumentType::class);
    }

    public function created_by() {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function edited_by() {
        return $this->hasOne(User::class, 'id', 'edited_by');
    }

}
