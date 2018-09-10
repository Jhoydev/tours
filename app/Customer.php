<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\DocumentType;
use App\Country;
use App\State;
use App\City;
use App\User;

class Customer extends Authenticatable
{

    use Notifiable,
        SoftDeletes;

    protected $fillable = [
        'first_name', 'last_name', 'document_type_id', 'document', 'email',
        'phone', 'mobile', 'address', 'address2', 'city_id', 'state_id', 'zip_code',
        'country_id', 'profession', 'workplace', 'password', 'edited_by', 'created_by'
    ];
    protected $dates    = ["deleted_at", "created_at", "updated_at"];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = ['password', 'remember_token'];

    public function setPasswordAttribute($password)
    {
        if (Hash::needsRehash($password))
            $password = Hash::make($password);

        $this->attributes['password'] = $password;
    }

    public function document_type()
    {
        return $this->belongsTo(DocumentType::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function state()
    {
        return $this->belongsTo(State::class);
    }

    public function city()
    {
        return $this->belongsTo(City::class);
    }

    public function created_by()
    {
        return $this->hasOne(User::class, 'id', 'created_by');
    }

    public function edited_by()
    {
        return $this->hasOne(User::class, 'id', 'edited_by');
    }

}
