<?php

namespace App\Console\Commands;

use App\Report;
use App\Sale;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;


class DailyReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:daily';

    /**
     * The console command description
     *
     * @var string
     */
    protected $description = 'Create Daily Report';

    /**
     * Create a new command instance.
     *
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $report = new Report();
        $total_purchases = DB::table('purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('total') +
            DB::table('chick_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('total') +
            DB::table('feed_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('total');
        $report->total_purchase = $total_purchases;
        $total_expenses = DB::table('expenses')->whereDate('created_at', '=', date('Y-m-d'))->sum('total');
        $report->total_expense = $total_expenses;
        $total_less = DB::table('purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('less') +
            DB::table('chick_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('less') +
            DB::table('feed_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('less');
        $report->total_less = $total_less;
        $total_cost = $total_purchases + $total_expenses;
        $report->total_cost = $total_cost;
        $total_sale = DB::table('sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('total') +
            DB::table('chick_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('total') +
            DB::table('feed_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('total');
        $report->total_sale = $total_sale;
        $cheque_sale_others = DB::table('sales')->whereDate('updated_at', '=', date('Y-m-d'))->where('payment_type', 'Cheque')->sum('payment') +
            DB::table('chick_sales')->whereDate('updated_at', '=', date('Y-m-d'))->where('payment_type', 'Cheque')->sum('payment') +
            DB::table('feed_sales')->whereDate('updated_at', '=', date('Y-m-d'))->where('payment_type', 'Cheque')->sum('payment');
        $report->cheque_sale_others = $cheque_sale_others;
        $cash_sale = $total_sale - $cheque_sale_others;
        $report->cash_sale = $cash_sale;
        $collection = DB::table('sales')->whereDate('updated_at', '=', date('Y-m-d'))->where('payment_type', 'Cash')->sum('payment') +
            DB::table('chick_sales')->whereDate('updated_at', '=', date('Y-m-d'))->where('payment_type', 'Cash')->sum('payment') +
            DB::table('feed_sales')->whereDate('updated_at', '=', date('Y-m-d'))->where('payment_type', 'Cash')->sum('payment');
        $report->collection = $collection;
        $balance = $cash_sale - $collection;
        $report->balance = $balance;
        $profit = $total_sale - $total_cost;
        $report->profit = $profit;
        $latest_report = DB::table('reports')->latest()->first();
        $previous_balance = $latest_report->previous_balance +
            DB::table('sales')->whereDate('updated_at', '=', date('Y-m-d'))->sum('payment') +
            DB::table('chick_sales')->whereDate('updated_at', '=', date('Y-m-d'))->sum('payment') +
            DB::table('feed_sales')->whereDate('updated_at', '=', date('Y-m-d'))->sum('payment')-
            DB::table('purchases')->whereDate('updated_at', '=', date('Y-m-d'))->sum('payment') -
            DB::table('chick_purchases')->whereDate('updated_at', '=', date('Y-m-d'))->sum('payment') -
            DB::table('feed_purchases')->whereDate('updated_at', '=', date('Y-m-d'))->sum('payment') -
            DB::table('expenses')->whereDate('created_at', '=', date('Y-m-d'))->sum('total');
        $report->previous_balance = $previous_balance;
        $report->save();


    }
}
