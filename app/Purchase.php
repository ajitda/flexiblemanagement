<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    protected $fillable=['qty', 'weight', 'price_per_kg', 'sub_total', 'death_qty', 'transport', 'daily_stuff_salary', 'others', 'total', 'payment', 'supplier_id' ];

    public function supplier()
    {
        return $this->belongsTo('App\Supplier');
    }
}
