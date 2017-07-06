<?php

namespace App\Http\Controllers;


use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
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
        $employees = User::all();
        return view('employees.employees',compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('employees.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|unique:users',
            'password' => 'required|min:6|max:18',
            'email' => 'required|string|email|max:255|unique:users',
        ]);
        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }
        $input = new User();
        $input->name = $request->name;
        $input->email = $request->email;
        $input->role = $request->role;
        $input->password = bcrypt($request->password);
        $input->save();
        return redirect('/employees');
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

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = User::findOrFail($id);
        return view('employees.edit', compact('employee'));
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
        if($id == 1)
        {
            Session::flash('message', 'You cannot edit admin on Flexible Management');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('employees');
        }
        else{
            $validator = Validator::make($request->all(), [
                'name' => 'required',
                'password' => 'required|min:6|max:18',
                'email' => 'required|string|email|max:255',
            ]);
            if($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInput();
            }
            $input = User::findOrFail($id);
            $input->name = $request->name;
            $input->email = $request->email;
            $input->role = $request->role;
            $input->password = bcrypt($request->password);
            $input->update();
            return redirect('employees');
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if($id == 1)
        {
            Session::flash('message', 'You cannot delete admin on Flexible Management');
            Session::flash('alert-class', 'alert-danger');
            return Redirect::to('employees');
        }
        else {
            if(Auth::guard('admin')){
                User::findOrFail($id)->delete();
                return redirect()->back();
            }

        }
    }
}
