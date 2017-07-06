<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChickPurchase extends Model
{
    protected $fillable=['qty', 'unit_price', 'sub_total', 'costing', 'total','less', 'payment','dues', 'chick_supplier_id' ];

    public function chick_supplier()
    {
        return $this->belongsTo('App\ChickSupplier');
    }
}
