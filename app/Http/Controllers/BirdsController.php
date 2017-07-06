<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Purchase;
use App\Sale;
use App\Supplier;
use Illuminate\Http\Request;

class BirdsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $suppliers = Supplier::count();
       $customers = Customer::count();
        $purchases = Purchase::count();
        $sales = Sale::count();
        $total_cost = Purchase::sum('payment');
        $total_earning = Sale::sum('payment');

        return view('birds.index', compact('suppliers', 'customers', 'purchases', 'sales', 'total_cost', 'total_earning'));
    }
}
