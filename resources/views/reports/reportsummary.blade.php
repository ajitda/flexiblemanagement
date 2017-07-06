@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading text-center">
                        <h2>Total Buy/Sale/Collection & Profit</h2>
                        <div class="row hidden-print complete-btn">
                            <div class="col-md-3">
                                <div class="form-group form-inline">
                                    <label for="StartDate">From</label>
                                    <input type="text" name="StartDate" id="StartDate" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-inline">
                                    <label for="EndDate">To</label>
                                    <input type="text" name="EndDate" id="EndDate" class="form-control" required />
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body" id="list-summary-report">
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>Date</th>
                                <th>Purchase</th>
                                <th>Expense</th>
                                <th>Less</th>
                                <th>Cost</th>
                                <th>Total Sale</th>
                                <th>Cheque Sale & Others</th>
                                <th>Cash Sale</th>
                                <th>Collection</th>
                                <th>Balance</th>
                                <th>Profit</th>
                            </tr>
                            </thead>
                            <tbody>
                            @foreach($reportsummarys as $reportsummary)
                                <tr>
                                    <td>{{$reportsummary->created_at}}</td>
                                    <td>{{$reportsummary->total_purchase }}</td>
                                    <td>{{$reportsummary->total_expense}}</td>
                                    <td>{{$reportsummary->total_less }}</td>
                                    <td>{{$reportsummary->total_cost }}</td>
                                    <td>{{$reportsummary->total_sale}}</td>
                                    <td>{{$reportsummary->cheque_sale_others}}</td>
                                    <td>{{$reportsummary->cash_sale}}</td>
                                    <td>{{$reportsummary->collection}}</td>
                                    <td>{{$reportsummary->balance}}</td>
                                    <td>{{$reportsummary->profit}}</td>

                                    {{--<td>--}}
                                        {{--<a href="expenses/{{$reportsummary->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>--}}
                                    {{--</td>--}}
                                    {{--<td>--}}
                                        {{--{!! Form::open(['method'=> 'DELETE', 'route'=>['expenses.destroy', $expense->id]]) !!}--}}
                                        {{--{!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}--}}
                                        {{--{!! Form::close() !!}--}}
                                    {{--</td>--}}
                                </tr>
                            @endforeach

                            </tbody>
                        </table>
                        {{--<div class="paginatios col-lg-12">--}}
                        {{--{!! $expenses->render() !!}--}}
                        {{--</div>--}}
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
                var EndDate = $('#EndDate').val();

                listSales(DateCreated,EndDate);
            }
        });
        $("#EndDate").datepicker({
            changeDate:true,
            changeMonth:true,
            changeYear:true,
            yearRange:'1970:+0',
            dateFormat:'yy-mm-dd',
            onSelect:function(dateText){
                var DateCreated = $('#StartDate').val();
                var EndDate = $('#EndDate').val();
                listSales(DateCreated, EndDate);
            }
        });
        function listSales(criteria1, criteria2)
        {
            $.ajax({
                type : 'get',
                url : "{!! url('/reports/getallsummary') !!}",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#list-summary-report').empty().html(data);
                }
            })
        }

    </script>
@endsection