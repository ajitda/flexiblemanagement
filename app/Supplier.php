<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = ['supplier_name','address','image','phone','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function purchase()
    {
        return $this->hasMany('App\Purchase');
    }
}
