<?php

namespace App\Http\Controllers;

use App\FeedCustomer;
use App\FeedPurchase;
use App\FeedSale;
use App\FeedSupplier;
use Illuminate\Http\Request;

class FeedController extends Controller
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
        $suppliers = FeedSupplier::count();
        $customers = FeedCustomer::count();
        $purchases = FeedPurchase::count();
        $sales = FeedSale::count();
        $total_cost = FeedPurchase::sum('payment');
        $total_earning = FeedSale::sum('payment');

        return view('Feeds.index', compact('suppliers', 'customers', 'purchases', 'sales', 'total_cost', 'total_earning'));
    }
}
