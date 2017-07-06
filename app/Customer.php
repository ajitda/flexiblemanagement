<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    protected $fillable = ['name', 'address', 'image', 'phone', 'payment', 'balance', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function sale(){
        return $this->hasMany('App\Sale');
    }
}
