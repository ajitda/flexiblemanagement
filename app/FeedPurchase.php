<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FeedPurchase extends Model
{
    protected $fillable=['qty', 'unit_price', 'sub_total', 'costing', 'total', 'payment', 'feed_supplier_id' ];

    public function feed_supplier()
    {
        return $this->belongsTo('App\FeedSupplier');
    }
}
