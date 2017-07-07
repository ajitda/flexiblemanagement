@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row sales_heading">
                            <div class="col-md-2">
                                Chicks Sales List
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
                               <a href="chicksales/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                           </div>
                        </div>
                    </div>
                    @if(count($sales))
                    <div class="panel-body" id="list-sale-report">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-bordered table-striped table-hover" >
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created at</th>
                                    <th>Customers</th>
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
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{$sale->id}}</td>
                                    <td>{{$sale->created_at->format('d-m-Y')}}</td>
                                    <td>{{$sale->chick_customer->name}}</td>
                                    <td>{{$sale->chick_supplier->supplier_name}}</td>
                                    <td>{{$sale->qty}}</td>
                                    <td>{{$sale->unit_price}}</td>
                                    <td>{{$sale->sub_total}}</td>
                                    <td>{{$sale->costing}}</td>

                                    <td>{{$sale->total}}</td>
                                    <td>{{$sale->less}}</td>
                                    <td>{{$sale->payment}}</td>
                                    <td>{{$sale->dues}}</td>

                                    <td>
                                        <a href="chicksales/{{$sale->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    @if($user == 'admin')
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        {!! Form::open(['method'=> 'DELETE', 'route'=>['chicksales.destroy', $sale->id]]) !!}
                                        {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                                        {!! Form::close() !!}</a>
                                    </td>
                                        @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            {!! $sales->render() !!}
                        </div>
                    </div>
                    @endif
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
                url : "{!! url('/chicks/sales/getsaleslist') !!}",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#list-sale-report').empty().html(data);
                }
            })
        }

    </script>
@endsection