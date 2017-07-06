<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChickSupplier extends Model
{
    protected $fillable = ['supplier_name','address','image','phone','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function chick_purchase()
    {
        return $this->hasMany('App\ChickPurchase');
    }
}
