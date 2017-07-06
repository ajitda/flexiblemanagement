<?php

namespace App\Http\Controllers;

use App\Customer;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class CustomersController extends Controller
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
        $customers = Customer::orderBy('id', 'desc')->paginate(19);
        $user = Auth::user()->role;
        return view('birds.customers.customers', compact('customers', 'user'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('birds.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $input = $request->all();
        if(isset($input['image'])){
            $input['image'] = $this->upload($input['image']);
        }else{
            $input['image'] = 'img/default.jpg';
        }
        $input['user_id'] = Auth::user()->id;
        Customer::create($input);
        Session::flash('message', 'customer created successfully');
        return redirect('customers');
    }

    public function upload($file)
    {
        $extension = $file->getClientOriginalExtension();
        $sha = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."_".$sha.".".$extension;
        $path = public_path('img/birds/customers/');
        $file->move($path, $filename);
        return 'img/birds/customers/'.$filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = Customer::findOrFail($id);
        $sales = $customer->sale;
        $user = Auth::user()->role;
        return view('birds.customers.customer', compact('customer','sales', 'user'));
    }
    public function getSales($id)
    {
        $customer = Customer::findOrFail($id)->orderBy('id', 'desc');
        $sales = $customer->sale;
        $user = Auth::user()->role;
        return view('birds.customers.getsale', compact('customer','sales', 'user'));
    }
    public function getSaleslist(Request $request)
    {
        if($request->ajax()) {
            $customer = Customer::findOrFail($request->CustomerId);
            $user = Auth::user()->role;
            $sales = Sale::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->where('customer_id', $request->CustomerId)->get();
            return view('birds.customers.customerlistsale')->with('sales', $sales)->with('user', $user)->with('customer', $customer)->with('request', $request);
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
        $customer = Customer::findOrFail($id);
        return view('birds.customers.edit', compact('customer'));
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
        $input = $request->all();
        if(isset($input['image']))
            $input['image'] = $this->upload($input['image']);
        Customer::findOrFail($id)->update($input);
        Session::flash('message', 'Customer updated successfully');
        return redirect('customers');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {   $user = Auth::user()->role;
        if($user == 'admin'){
        Customer::findOrFail($id)->delete();
        return redirect()->back();
    }

    }
}
