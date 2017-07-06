<?php

namespace App\Http\Controllers;

use App\ChickCustomer;
use App\ChickPurchase;
use App\ChickSale;
use App\ChickSupplier;
use Illuminate\Http\Request;

class ChicksController extends Controller
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
        $suppliers = ChickSupplier::count();
        $customers = ChickCustomer::count();
        $purchases = ChickPurchase::count();
        $sales = ChickSale::count();
        $total_cost = ChickPurchase::sum('payment');
        $total_earning = ChickSale::sum('payment');

        return view('chicks.index', compact('suppliers', 'customers', 'purchases', 'sales', 'total_cost', 'total_earning'));
    }
}
