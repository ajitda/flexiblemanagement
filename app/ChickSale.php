<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChickSale extends Model
{
    protected $fillable=['qty', 'unit_price','sub_total', 'costing', 'total', 'less', 'payment', 'payment_type', 'dues', 'chick_supplier_id', 'chick_customer_id'];

    public function chick_customer()
    {
        return $this->belongsTo('App\ChickCustomer');
    }
    public function chick_supplier()
    {
        return $this->belongsTo('App\ChickSupplier');
    }
}
