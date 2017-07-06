<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Sale;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SaleController extends Controller
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
        $sales = Sale::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user()->role;
        return view('birds.sales.sales', compact('sales', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Customer::pluck('name', 'id');
        $suppliers = Supplier::pluck('supplier_name', 'id');
        return view('birds.sales.create', compact('customers', 'suppliers'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sales = new Sale();
        $sales->customer_id = $request->customer_id;
        $sales->supplier_id = $request->supplier_id;
        $qty = $sales->qty = $request->qty;
        $weight = $sales->weight = $request->weight;
        $tweight = $sales->tweight = $request->tweight;
        $price_per_kg = $sales->price_per_kg = $request->price_per_kg;
        $sub_total= $tweight * $price_per_kg;
        $sales->sub_total = $sub_total;
        $death= $sales->death_qty = $request->death_qty;
        $less = $sales->less = $request->less;
        $total = $sub_total - ($death * $weight * $price_per_kg);
        $sales->total = $total;
        $payment = $sales->payment = $request->payment;
        $sales->payment_type = $request->payment_type;
        $dues = $total - $payment - $less;
        $sales->dues = $dues;
        $sales->save();
        Session::flash('message', 'Bird Sale Created Successfully');
        return redirect('sales');
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

            $sales = Sale::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            $user = Auth::user()->role;
            return view('birds.sales.listsale')->with('sales', $sales)->with('user', $user);
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
        $sale = Sale::findOrfail($id);
        $customers = Customer::pluck('name', 'id');
        $suppliers = Supplier::pluck('supplier_name', 'id');
        return view('birds.sales.edit', compact('sale','customers', 'suppliers'));
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
        $sales = Sale::findOrFail($id);
        $sales->customer_id = $request->customer_id;
        $sales->supplier_id = $request->supplier_id;
        $qty = $sales->qty = $request->qty;
        $weight = $sales->weight = $request->weight;
        $tweight = $sales->tweight = $request->tweight;
        $price_per_kg = $sales->price_per_kg = $request->price_per_kg;
        $sub_total= $tweight * $price_per_kg;
        $sales->sub_total = $sub_total;
        $death= $sales->death_qty = $request->death_qty;
        $less = $sales->less = $request->less;
        $total = $sub_total - ($death * $weight * $price_per_kg);
        $sales->total = $total;
        $payment = $sales->payment = $request->payment;

        $sales->payment_type = $request->payment_type;
        $dues = $total - $payment - $less;
        $sales->dues = $dues;
        $sales->update();
        Session::flash('message', 'Bird Sale Updated Successfully');
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
        $user= Auth::user()->role;
        if($user == 'admin'){
            Sale::findOrFail($id)->delete();
            return redirect()->back();
        }

    }
}
