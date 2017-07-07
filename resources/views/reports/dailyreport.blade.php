@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading hidden-print">Daily Report</div>

                <div class="panel-body">
                    {{--{{ trans('dashboard.welcome') }}--}}
                    <div class="row">

                        <div class="col-md-4">
                            <div class="form-group form-inline hidden-print">
                                <label for="StartDate">Select Date</label>
                                <input type="text" name="StartDate" id="StartDate" class="form-control" required />
                            </div>
                        </div>
                        <div class="col-md-5">
                            <h3 class="panel-title text-left" style="margin-left: 50px;">DAILY INCOME AND EXPENSE</h3>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-12" id="daily-report">
                            <h4 class="text-center"> Date : {{\Carbon\Carbon::today()->format('Y-m-d')}}</h4>
                            <table class="table table-bordered table-striped table-hover">
                                <thead>
                                <tr>
                                    <th>Income Source</th>
                                    <th>Expense Source</th>
                                    <th>Debit</th>
                                    <th>Credit</th>
                                    <th>Balance</th>
                                </tr>
                                </thead>
                                <tbody>

                                <tr>
                                    <td>Previous Balance</td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td>
                                        {{number_format($latest_report->previous_balance)}}
                                    </td>
                                </tr>
                                {{--get daily sales for birds--}}

                                @foreach($birdsales as $birdsale)
                                    @if($birdsale->payment > '0.00')
                                    <tr>
                                        <td>{{$birdsale->customer->name}}</td>
                                        <td></td>
                                        <td>{{$birdsale->payment}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{--get daily sales for feed--}}
                                @foreach($feedsales as $feedsale)
                                    @if($feedsale->payment > '0.00')
                                    <tr>
                                        <td>{{$feedsale->feed_customer->name}}</td>
                                        <td></td>
                                        <td>{{$feedsale->payment}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{--get daily sales for chicks--}}
                                @foreach($chicksales as $chicksale)
                                    @if($chicksale->payment > '0.00')
                                    <tr>
                                        <td>{{$chicksale->chick_customer->name}}</td>
                                        <td></td>
                                        <td>{{number_format($chicksale->payment)}}</td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{--get daily purchases for birds--}}
                                @foreach($birdpurchases as $birdpurchase)
                                    @if($birdpurchase->payment > '0.00')
                                    <tr>
                                        <td></td>
                                        <td>{{$birdpurchase->supplier->supplier_name}}</td>
                                        <td></td>
                                        <td>{{number_format($birdpurchase->payment)}}</td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{--get daily purchases for chicks--}}
                                @foreach($chickpurchases as $chickpurchase)
                                    @if($chickpurchase->payment > '0.00')
                                    <tr>
                                        <td></td>
                                        <td>{{$chickpurchase->chick_supplier->supplier_name}}</td>
                                        <td></td>
                                        <td>{{number_format($chickpurchase->payment)}}</td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{--get daily purchases for feed--}}
                                @foreach($feedpurchases as $feedpurchase)
                                    @if($feedpurchase->payment > '0.00')
                                    <tr>
                                        <td></td>
                                        <td>{{$feedpurchase->feed_supplier->supplier_name}}</td>
                                        <td></td>
                                        <td>{{number_format($feedpurchase->payment)}}</td>
                                        <td></td>
                                    </tr>
                                    @endif
                                @endforeach
                                {{--get daily expenses--}}
                                @foreach($expenses as $expense)
                                    <tr>
                                        <td></td>
                                        <td>{{$expense->description.' - '.$expense->expense_category->name}}</td>
                                        <td></td>
                                        <td>{{number_format($expense->total)}}</td>
                                        <td></td>
                                    </tr>
                                @endforeach

                                    <tr>
                                        <td>Total</td>
                                        <td></td>
                                        <td>
                                            {{number_format(DB::table('sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('chick_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('feed_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment'))}}
                                        </td>
                                        <td>
                                            {{number_format(DB::table('purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('chick_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('feed_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('expenses')->whereDate('created_at', '=', date('Y-m-d'))->sum('total'))}}
                                        </td>
                                        <td>
                                            {{number_format($latest_report->previous_balance  +
                                            DB::table('sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('chick_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') +
                                            DB::table('feed_sales')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment')-
                                            DB::table('purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') -
                                            DB::table('chick_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') -
                                            DB::table('feed_purchases')->whereDate('created_at', '=', date('Y-m-d'))->sum('payment') -
                                            DB::table('expenses')->whereDate('created_at', '=', date('Y-m-d'))->sum('total'))}}

                                        </td>
                                    </tr>


                                </tbody>
                            </table>

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script type="text/javascript">
        $("#StartDate").datepicker({
            changeDate:true,
            changeMonth:true,
            changeYear:true,
            yearRange:'1970:+0',
            dateFormat:'yy-mm-dd',
            onSelect:function(dateText){
                var DateCreated = $('#StartDate').val();
                listSales(DateCreated);
            }
        });
        function listSales(criteria1)
        {
            $.ajax({
                type : 'get',
                url : "{!! url('/getdailyreport') !!}",
                data : {DateCreated:criteria1},
                success:function(data)
                {
                    $('#daily-report').empty().html(data);
                }
            })
        }

    </script>
@endsection
