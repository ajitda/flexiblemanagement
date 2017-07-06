<?php

namespace App\Http\Controllers;

use App\FeedPurchase;
use App\FeedSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FeedPurchaseController extends Controller
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
        $purchases = FeedPurchase::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user()->role;
        return view('feeds.purchases.purchases', compact('purchases', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $suppliers = FeedSupplier::pluck('supplier_name', 'id');
        return view('feeds.purchases.create', compact('suppliers', 'request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchases= new FeedPurchase();
        $purchases->feed_supplier_id = $request->supplier_id;
        $qty = $purchases->qty = $request->qty;
        $unit_price = $purchases->unit_price = $request->unit_price;

        $sub_total= $qty * $unit_price;
        $purchases->sub_total = $sub_total;

        $costing = $purchases->costing = $request->costing;
        $total = $sub_total + $costing;
        $purchases->total = $total;
        $less = $purchases->less = $request->less;
        $payment = $purchases->payment = $request->payment;
        $dues = $total - $less - $payment;
        $purchases->dues = $dues;

        $purchases->save();
        Session::flash('message', 'Feed Purchase Created Successfully');
        return redirect('feedpurchases');
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
    /*
     * Show datewise purchase list
     */
    public function getpurchaselist(Request $request)
    {
        if($request->ajax()){
            $purchases = FeedPurchase::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            $user = Auth::user()->role;
            return view('feeds.purchases.listpurchase')->with('purchases', $purchases)->with('user', $user);
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
        $purchase = FeedPurchase::findOrFail($id);
        $suppliers = FeedSupplier::pluck('supplier_name', 'id');
        return view('feeds.purchases.edit', compact('purchase', 'suppliers'));
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
        $purchases= FeedPurchase::findOrFail($id);
        $purchases->feed_supplier_id = $request->feed_supplier_id;
        $qty = $purchases->qty = $request->qty;
        $unit_price = $purchases->unit_price = $request->unit_price;

        $sub_total= $qty * $unit_price;
        $purchases->sub_total = $sub_total;

        $costing = $purchases->costing = $request->costing;
        $total = $sub_total + $costing;
        $less = $purchases->less = $request->less;
        $payment = $purchases->payment = $request->payment;
        $dues = $total - $less - $payment;
        $purchases->dues = $dues;
        $purchases->update();
        Session::flash('message', 'Feed Purchase Updated Successfully');
        return redirect('chickpurchases');
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
        if($user == 'admin') {
            FeedPurchase::findOrFail($id)->delete();
            return redirect()->back();
        }
    }
}
