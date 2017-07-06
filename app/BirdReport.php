<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BirdReport extends Model
{
    protected $fillable=['total_purchase','total_expense','total_less','total_cost','total_sale','cheque_sale_others','cash_sale','collection','balance','profit'];
}
