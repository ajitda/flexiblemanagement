<?php

namespace App\Http\Controllers;

use App\ChickPurchase;
use App\ChickSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChickPurchaseController extends Controller
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
        $purchases = ChickPurchase::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user()->role;
        return view('chicks.purchases.purchases', compact('purchases', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $suppliers = ChickSupplier::pluck('supplier_name', 'id');
        return view('chicks.purchases.create', compact('suppliers', 'request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchases= new ChickPurchase();
        $purchases->chick_supplier_id = $request->supplier_id;
        $qty = $purchases->qty = $request->qty;
        $unit_price = $purchases->unit_price = $request->unit_price;

        $sub_total= $qty * $unit_price;
        $purchases->sub_total = $sub_total;

       $costing = $purchases->costing = $request->costing;
        $total = $sub_total + $costing;
        $less = $purchases->less= $request->less;
        $purchases->total = $total;
        $payment = $purchases->payment = $request->payment;
        $dues = $total - $less - $payment;
        $purchases->dues = $dues;
        $purchases->save();
        Session::flash('message', 'Chick Purchase Created Successfully');
        return redirect('chickpurchases');
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
     * Showing date wise purchase list
     */
    public function getpurchaselist(Request $request)
    {
        if($request->ajax()){
            $purchases = ChickPurchase::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            $user = Auth::user()->role;
            return view('chicks.purchases.listpurchase')->with('purchases', $purchases)->with('user', $user);
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
        $purchase = ChickPurchase::findOrFail($id);
        $suppliers = ChickSupplier::pluck('supplier_name', 'id');
        return view('chicks.purchases.edit', compact('purchase', 'suppliers'));
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
        $purchases= ChickPurchase::findOrFail($id);
        $purchases->chick_supplier_id = $request->chick_supplier_id;
        $qty = $purchases->qty = $request->qty;
        $unit_price = $purchases->unit_price = $request->unit_price;

        $sub_total= $qty * $unit_price;
        $purchases->sub_total = $sub_total;

        $costing = $purchases->costing = $request->costing;
        $total = $sub_total + $costing;
        $purchases->total = $total;
        $less = $purchases->less= $request->less;
        $purchases->total = $total;
        $payment = $purchases->payment = $request->payment;
        $dues = $total - $less - $payment;
        $purchases->dues = $dues;
        $purchases->update();
        Session::flash('message', 'Chick Purchase Updated Successfully');
        return redirect()->back();
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
        if($user == 'admin'){
            ChickPurchase::findOrFail($id)->delete();
            return redirect()->back();
        }
    }
}
