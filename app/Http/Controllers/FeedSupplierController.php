<?php

namespace App\Http\Controllers;

use App\FeedSupplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class FeedSupplierController extends Controller
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
        $suppliers = FeedSupplier::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user()->role;
        return view('feeds.suppliers.suppliers', compact('suppliers', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('feeds.suppliers.create');
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
        FeedSupplier::create($input);
        Session::flash('message', 'Feed Supplier Created Successfully');
        return redirect('feedsuppliers');
    }

    public function upload($file)
    {
        $extension = $file->getClientOriginalExtension();
        $sha = sha1($file->getClientOriginalName());
        $filename = date('Y-m-d-h-i-s')."_".$sha.".".$extension;
        $path = public_path('img/feeds/suppliers/');
        $file->move($path, $filename);
        return 'img/feeds/suppliers/'.$filename;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $supplier = FeedSupplier::findOrFail($id);
        $user = Auth::user()->role;
        return view('feeds.suppliers.supplier', compact('supplier', 'user'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $supplier = FeedSupplier::findOrFail($id);
        return view('feeds.suppliers.edit', compact('supplier'));
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
        FeedSupplier::findOrFail($id)->update($input);
            Session::flash('message', 'Feed Supplier Updated Successfully');
        return redirect('feedsuppliers');
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
            FeedSupplier::findOrFail($id)->delete();
            Session::flash('message', 'Feed Supplier Deleted Successfully');
            return redirect()->back();
        }
    }
}
