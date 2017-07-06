<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Expense extends Model
{
    protected $fillable = ['expense_category_id', 'description', 'qty', 'unit_expense', 'total', 'user_id'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }


    public function expense_category()
    {
        return $this->belongsTo('App\ExpenseCategory');
    }


}
