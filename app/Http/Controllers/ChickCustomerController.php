<?php

namespace App\Http\Controllers;

use App\ChickCustomer;
use App\ChickSale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class ChickCustomerController extends Controller
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
        $customers = ChickCustomer::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user()->role;
        return view('chicks.customers.customers', compact('customers', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('chicks.customers.create');
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
        ChickCustomer::create($input);
        Session::flash('message', 'Chick Customer Created Successfully');
        return redirect('chickcustomers');
    }
    public function upload($file)
    {
        $extension = $file->getClientOriginalExtension();
        $sha = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."_".$sha.".".$extension;
        $path = public_path('img/chicks/customers/');
        $file->move($path, $filename);
        return 'img/chicks/customers/'.$filename;
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $customer = ChickCustomer::findOrFail($id);
        $sales = $customer->chick_sale;
        $user = Auth::user()->role;
        return view('chicks.customers.customer', compact('customer','sales', 'user'));
    }
    public function getSales($id)
    {
        $customer = ChickCustomer::findOrFail($id)->orderBy('id', 'desc');
        $sales = $customer->chick_sale;
        $user = Auth::user()->role;
        return view('chicks.customers.getsale', compact('customer','sales', 'user'));
    }
    public function getSaleslist(Request $request)
    {

        if($request->ajax()) {
            $user = Auth::user()->role;
            $sales = ChickSale::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->where('chick_customer_id', $request->CustomerId)->get();

            return view('chicks.customers.customerlistsale')->with('sales', $sales)->with('user', $user);
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
        $customer = ChickCustomer::findOrFail($id);
        return view('chicks.customers.edit', compact('customer'));
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
        ChickCustomer::findOrFail($id)->update($input);
        Session::flash('message', 'Chick Customer Updated Successfully');
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
            ChickCustomer::findOrFail($id)->delete();
            return redirect()->back();
        }

    }
}
