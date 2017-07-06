<?php

namespace App\Http\Controllers;

use App\FeedCustomer;
use App\FeedSale;
use App\FeedSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FeedSaleController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = FeedSale::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user()->role;
        return view('feeds.sales.sales', compact('sales', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = FeedCustomer::pluck('name', 'id');
        $suppliers = FeedSupplier::pluck('supplier_name', 'id');
        return view('feeds.sales.create', compact('customers', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sales = new FeedSale();
        $sales->feed_customer_id = $request->feed_customer_id;
        $sales->feed_supplier_id = $request->feed_supplier_id;
        $qty = $sales->qty = $request->qty;
        $unit_price = $sales->unit_price = $request->unit_price;
        $sub_total= $qty * $unit_price;
        $sales->sub_total = $sub_total;
        $costing = $sales->costing = $request->costing;
        $total = $sub_total + $costing;
        $sales->total = $total;
        $less = $sales->less = $request->less;
        $payment = $sales->payment = $request->payment;

        $sales->payment_type = $request->payment_type;
        $dues = $total - $payment - $less;
        $sales->dues = $dues;
        $sales->save();
        Session::flash('message', 'Feed Sale Created Successfully');
        return redirect('feedsales');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    public function salesList(Request $request)
    {
        if($request->ajax()) {

            $sales = FeedSale::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            $user = Auth::user()->role;
            return view('feeds.sales.listsale')->with('sales', $sales)->with('user', $user);
        }
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $sale = FeedSale::findOrfail($id);
        $customers = FeedCustomer::pluck('name', 'id');
        $suppliers = FeedSupplier::pluck('supplier_name', 'id');
        return view('feeds.sales.edit', compact('sale','customers', 'suppliers'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $sales = FeedSale::findOrFail($id);
        $sales->feed_customer_id = $request->feed_customer_id;
        $sales->feed_supplier_id = $request->feed_supplier_id;
        $qty = $sales->qty = $request->qty;
        $unit_price = $sales->unit_price = $request->unit_price;
        $sub_total= $qty * $unit_price;
        $sales->sub_total = $sub_total;
        $costing = $sales->costing = $request->costing;
        $total = $sub_total + $costing;
        $sales->total = $total;
        $payment = $sales->payment = $request->payment;
        $less = $sales->less = $request->less;
        $sales->payment_type = $request->payment_type;
        $dues = $total - $payment - $less;
        $sales->dues = $dues;
        $sales->update();
        Session::flash('message', 'Feed Sale Updated Successfully');
        return redirect('feedsales');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user()->role;
        if($user=='admin') {
            FeedSale::findOrFail($id)->delete();
            return redirect()->back();
        }
    }
}
