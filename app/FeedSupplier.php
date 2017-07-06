<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedSupplier extends Model
{
    protected $fillable = ['supplier_name','address','image','phone','user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function feed_purchase()
    {
        return $this->hasMany('App\FeedPurchase');
    }
}
