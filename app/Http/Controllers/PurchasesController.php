<?php

namespace App\Http\Controllers;

use App\Purchase;
use App\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class PurchasesController extends Controller
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
        $purchases = Purchase::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user()->role;
        return view('birds.purchases.purchases', compact('purchases', 'user'));
    }
    public function getpurchaselist(Request $request)
    {
        if($request->ajax()){
            $purchases = Purchase::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            $user = Auth::user()->role;
            return view('birds.purchases.listpurchase')->with('purchases', $purchases)->with('user', $user);
        }
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $suppliers = Supplier::pluck('supplier_name', 'id');
        return view('birds.purchases.create', compact('suppliers', 'request'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $purchases= new Purchase();
        $purchases->supplier_id = $request->supplier_id;
        $qty = $purchases->qty = $request->qty;
        $weight = $purchases->weight = $request->weight;
        $tweight = $purchases->tweight = $request->tweight;
        $price_per_kg = $purchases->price_per_kg = $request->price_per_kg;
        $death= $purchases->death_qty = $request->death_qty;
        $sub_total= $tweight * $price_per_kg - ($death * $weight * $price_per_kg);
        $purchases->sub_total = $sub_total;
        $transport = $purchases->transport = $request->transport;
        $daily_stuff = $purchases->daily_stuff_salary = $request->daily_stuff_salary;
        $others = $purchases->others = $request->others;
        $less = $purchases->less = $request->less;
        $total = $sub_total + $transport + $daily_stuff + $others;
        $purchases->total = $total;
        $payment = $purchases->payment = $request->payment;
        $dues = $total - $payment - $less;
        $purchases->dues = $dues;
        $purchases->save();
        Session::flash('message', 'Bird Purchase Created Successfully');
        return redirect('purchases');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::findOrFail($id);
        $suppliers = Supplier::pluck('supplier_name', 'id');
        return view('birds.purchases.edit', compact('purchase', 'suppliers'));
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
        $purchases = Purchase::findOrFail($id);
        $purchases->supplier_id = $request->supplier_id;
        $qty = $purchases->qty = $request->qty;
        $weight = $purchases->weight = $request->weight;
        $tweight = $purchases->tweight = $request->tweight;
        $price_per_kg = $purchases->price_per_kg = $request->price_per_kg;
        $death = $purchases->death_qty = $request->death_qty;
        $sub_total= $tweight * $price_per_kg - ($death * $weight * $price_per_kg);
        $purchases->sub_total = $sub_total;
        $transport = $purchases->transport = $request->transport;
        $daily_stuff = $purchases->daily_stuff_salary = $request->daily_stuff_salary;
        $others = $purchases->others = $request->others;
        $less = $purchases->less = $request->less;
        $total = $sub_total + $transport + $daily_stuff + $others;
        $purchases->total = $total;
        $payment = $purchases->payment = $request->payment;
        $dues = $total - $payment - $less;
        $purchases->dues = $dues;
        $purchases->update();
        Session::flash('message', 'Bird Purchase Updated Successfully');
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
        if($user=='admin'){
            Purchase::findOrFail($id)->delete();
            return redirect()->back();
        }
    }
}
