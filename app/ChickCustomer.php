<?php

namespace App;


use Illuminate\Database\Eloquent\Model;

class ChickCustomer extends Model
{
    protected $fillable = ['name', 'address', 'image', 'phone', 'payment', 'balance', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function chick_sale(){
        return $this->hasMany('App\ChickSale');
    }
}
