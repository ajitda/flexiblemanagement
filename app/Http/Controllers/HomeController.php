<?php

namespace App\Http\Controllers;

use App\ChickCustomer;
use App\ChickPurchase;
use App\ChickSale;
use App\ChickSupplier;
use App\Customer;
use App\Expense;
use App\FeedCustomer;
use App\FeedPurchase;
use App\FeedSale;
use App\FeedSupplier;
use App\Purchase;
use App\Sale;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
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
        $suppliers = Supplier::count()+ FeedSupplier::count() + ChickSupplier::count();
       $customers = Customer::count() + FeedCustomer::count() + ChickCustomer::count();
        $purchases = Purchase::count() + FeedPurchase::count() + FeedCustomer::count();
        $sales = Sale::count() + FeedSale::count() + ChickSale::count();
        $total_cost = Purchase::sum('payment') + FeedPurchase::sum('payment') + ChickPurchase::sum('payment') + Expense::sum('total');
        $total_earning = Sale::sum('payment') + FeedSale::sum('payment') + ChickSale::sum('payment');
        $user = Auth::user()->role;

        return view('home', compact('suppliers', 'customers', 'purchases', 'sales', 'total_cost', 'total_earning', 'user'));
    }
}
