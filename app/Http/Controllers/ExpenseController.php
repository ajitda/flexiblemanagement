<?php

namespace App\Http\Controllers;

use App\Expense;
use App\ExpenseCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Symfony\Component\HttpFoundation\Tests\Session\Storage\Proxy\SessionHandlerProxyTest;

class ExpenseController extends Controller
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
        $expenses = Expense::orderBy('id', 'desc')->paginate(10);
        $user = Auth::user()->role;
        return view('expenses.expenses', compact('expenses', 'user'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $expense_categories = ExpenseCategory::pluck('name', 'id');
        return view('expenses.create', compact('expense_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $expense = new Expense();
        $expense->expense_category_id = $request->expense_category_id;
        $expense->description = $request->description;
        $qty = $expense->qty = $request->qty;
        $unit_expense = $expense->unit_expense = $request->unit_expense;
        $expense->total = $qty * $unit_expense;
        $expense->user_id = Auth::user()->id;
        $expense->save();
        Session::flash('message', 'Expense Created Successfully');
        return redirect('expenses');
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
     * Displaying date wise expense list with ajax
     *
     */
    public function getExpense(Request $request)
    {
        if($request->ajax()) {

            $expenses = Expense::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            $user = Auth::user()->role;
            return view('expenses.getexpenselist')->with('expenses', $expenses)->with('user', $user);
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
        $expense = Expense::findOrFail($id);
        $expense_categories = ExpenseCategory::pluck('name', 'id');
        return view('expenses.edit', compact('expense', 'expense_categories'));
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
        $expense = Expense::findOrFail($id);
        $expense->expense_category_id = $request->expense_category_id;
        $expense->description = $request->description;
        $qty = $expense->qty = $request->qty;
        $unit_expense = $expense->unit_expense = $request->unit_expense;
        $expense->total = $qty * $unit_expense;
        $expense->user_id = Auth::user()->id;
        $expense->update();
        Session::flash('message', 'Expense Created successfully');
        return redirect('expenses');
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
            $expense= Expense::findOrFail($id)->delete();
            return redirect()->back();
        }

    }
}
