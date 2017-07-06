<?php

namespace App\Http\Controllers;

use App\ChickCustomer;
use App\ChickSale;
use App\ChickSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChickSaleController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sales = ChickSale::orderBy('id', 'desc')->paginate(20);
        $user = Auth::user()->role;
        return view('chicks.sales.sales', compact('sales', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = ChickCustomer::pluck('name', 'id');
        $suppliers = ChickSupplier::pluck('supplier_name', 'id');
        return view('chicks.sales.create', compact('customers', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sales = new ChickSale();
        $sales->chick_customer_id = $request->chick_customer_id;
        $sales->chick_supplier_id = $request->chick_supplier_id;
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
        Session::flash('message', 'Chick Sale Created Successfully');
        return redirect('chicksales');
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

            $sales = ChickSale::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            $user = Auth::user()->role;
            return view('chicks.sales.listsale')->with('sales', $sales)->with('user', $user);
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
        $sale = ChickSale::findOrfail($id);
        $customers = ChickCustomer::pluck('name', 'id');
        $suppliers = ChickSupplier::pluck('supplier_name', 'id');
        return view('chicks.sales.edit', compact('sale','customers', 'suppliers'));
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
        $sales = ChickSale::findOrFail($id);
        $sales->chick_customer_id = $request->chick_customer_id;
        $sales->chick_supplier_id = $request->chick_supplier_id;
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
        $sales->update();
        Session::flash('message', 'Chick Sale Updated Successfully');
        return redirect('chicksales');
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
            ChickSale::findOrFail($id)->delete();
            return redirect()->back();
        }

    }
}
