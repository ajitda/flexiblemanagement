<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedSale extends Model
{
    protected $fillable=['qty', 'unit_price','sub_total', 'costing', 'total', 'payment', 'payment_type', 'dues', 'feed_supplier_id', 'feed_customer_id'];

    public function feed_customer()
    {
        return $this->belongsTo('App\FeedCustomer');
    }
    public function feed_supplier()
    {
        return $this->belongsTo('App\FeedSupplier');
    }
}
