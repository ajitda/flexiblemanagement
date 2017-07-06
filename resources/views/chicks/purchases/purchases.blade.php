@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row sales_heading">
                            <div class="col-md-2">
                                Chicks Purchases
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-inline">
                                    <label for="StartDate">From</label>
                                    <input type="text" name="StartDate" id="StartDate" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group form-inline">
                                    <label for="EndDate">To</label>
                                    <input type="text" name="EndDate" id="EndDate" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <a href="chickpurchases/create" class="pull-right"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body" id="purchase-list">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Suppliers</th>
                                    <th>Qty</th>
                                    <th>Unit Price</th>
                                    <th>Subtotal</th>
                                    <th>Costing</th>
                                    <th>Total</th>
                                    <th>Less</th>
                                    <th>Payment</th>
                                    <th>Dues</th>
                                    @if($user == 'admin')
                                    <th colspan="2">Actions</th>
                                        @else
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($purchases as $purchase)
                                <tr>
                                    <td>{{$purchase->id}}</td>
                                    <td>{{$purchase->chick_supplier->supplier_name}}</td>
                                    <td>{{$purchase->qty}}</td>
                                    <td>{{$purchase->unit_price}}</td>
                                    <td>{{$purchase->sub_total}}</td>
                                    <td>{{$purchase->costing}}</td>
                                    <td>{{$purchase->total}}</td>
                                    <td>{{$purchase->less}}</td>
                                    <td>{{$purchase->payment}}</td>
                                    <td>{{$purchase->dues}}</td>
                                    <td>
                                        <a href="chickpurchases/{{$purchase->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    @if($user == 'admin')
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        {!! Form::open(['method'=> 'DELETE', 'route'=>['chickpurchases.destroy', $purchase->id]]) !!}
                                        {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                                        {!! Form::close() !!}</a>
                                    </td>
                                        @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            {!! $purchases->render() !!}
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
                url : "{!! url('/chicks/purchases/getpurchaselist') !!}",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#purchase-list').empty().html(data);
                }
            })
        }

    </script>
@endsection