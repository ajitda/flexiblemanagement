<?php

namespace App\Http\Controllers;

use App\BirdReport;
use App\ChickPurchase;
use App\ChickSale;
use App\Expense;
use App\FeedPurchase;
use App\FeedSale;
use App\Purchase;
use App\Report;
use App\Sale;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportController extends Controller
{
    /**
     * Create a new controller instance.
     *
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function dailyreport(){
        $today = date('Y-m-d');
        $birdsales = Sale::where("updated_at", 'LIKE', "%$today%")->get();
        $birdpurchases = Purchase::where("updated_at", 'LIKE', "%$today%")->get();

        $chicksales = ChickSale::where("updated_at", 'LIKE', "%$today%")->get();
        $chickpurchases = ChickPurchase::where("updated_at", 'LIKE', "%$today%")->get();

        $feedsales = FeedSale::where("updated_at", 'LIKE', "%$today%")->get();
        $feedpurchases = FeedPurchase::where("updated_at", 'LIKE', "%$today%")->get();

        $expenses = Expense::where("updated_at", 'LIKE', "%$today%")->get();
        $latest_report = DB::table('reports')->latest()->first();

        return view('reports.dailyreport', compact('birdsales', 'birdpurchases', 'chicksales', 'chickpurchases', 'feedsales', 'feedpurchases', 'expenses', 'latest_report'));
    }

    public function getdailyreport(Request $request)
    {
        if($request->ajax()) {
            $birdsales = Sale::whereDate("updated_at", '=', $request->DateCreated)->get();
            $birdpurchases = Purchase::whereDate("updated_at", '=', $request->DateCreated)->get();

            $chicksales = ChickSale::whereDate("updated_at", '=', $request->DateCreated)->get();
            $chickpurchases = ChickPurchase::whereDate("updated_at", '=', $request->DateCreated)->get();

            $feedsales = FeedSale::whereDate("updated_at", '=', $request->DateCreated)->get();
            $feedpurchases = FeedPurchase::whereDate("updated_at", '=', $request->DateCreated)->get();

            $expenses = Expense::whereDate("updated_at", '=', $request->DateCreated)->get();
            $latest_reports = Report::whereDate("updated_at", '=', $request->DateCreated)->get();
            $balance = [];
            foreach($latest_reports as $latest_report){
                $balance = $latest_report->previous_balance;
            }
            return view('reports.report', compact('birdsales', 'birdpurchases', 'chicksales', 'chickpurchases', 'feedsales', 'feedpurchases', 'expenses', 'request', 'balance'));
        }

    }
    /*
     * Showing Total report summary
     */
    public function reportsummary()
    {
        $reportsummarys = Report::orderBy('id', 'desc')->paginate(10);
        return view('reports.reportsummary', compact('reportsummarys'));
    }
    /*
     * Showing Bird report summary
     */
    public function birdreports(){
        $birdreports = BirdReport::orderBy('id', 'desc')->paginate(10);
        return view('reports.birdsummary', compact('birdreports'));
    }

    /*
     * Showing datewise total report summary
     */
    public function getallsummary(Request $request)
    {
        if($request->ajax()){
            $reportsummarys = Report::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            return view('reports.summary')->with('reportsummarys', $reportsummarys);
        }
    }

    /*
     * Showing datewise total report summary
     */
    public function getbirdreportsummary(Request $request)
    {
        if($request->ajax()){
            $reportsummarys = BirdReport::whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->get();
            return view('reports.summary')->with('reportsummarys', $reportsummarys);
        }
    }
}
