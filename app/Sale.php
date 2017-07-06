<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable=['qty', 'weight', 'price_per_kg', 'sub_total', 'death_qty', 'total', 'payment', 'payment_type', 'dues'];

    public function customer()
    {
        return $this->belongsTo('App\Customer');
    }
    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }

}
