@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading"><strong>{{$supplier->supplier_name}}</strong>
                        <a href="{{$supplier->id}}/edit"><span class="glyphicon glyphicon-edit pull-right"></span></a>
                    </div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="col-md-6 col-md-offset-2">
                            <img class="img-responsive" src="../{{$supplier->image}}" alt=""><br>
                        <div class="text-left">
                           <strong>Address : </strong>  {{$supplier->address}}<br>
                            <strong>Phone : </strong> {{$supplier->phone}}<br>
                        </div>

                        </div>
                        <div class="col-md-4">
                            <h4><strong>Total Purchased : <span class="navy">Tk.{{number_format(DB::table('feed_purchases')->where('feed_supplier_id', $supplier->id)->sum('payment'), 2)}}</span></strong></h4>
                        </div>
                        <div class="clearfix"></div>
                        <h4><Strong>Purchased List:</Strong></h4>
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Created at</th>
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
                            @foreach($supplier->feed_purchase as $purchase)
                                <tr>
                                    <td>{{$purchase->id}}</td>
                                    <td>{{$purchase->created_at->format('d-m-Y')}}</td>
                                    <td>{{$purchase->qty}}</td>
                                    <td>{{$purchase->unit_price}}</td>
                                    <td>{{$purchase->sub_total}}</td>
                                    <td>{{$purchase->costing}}</td>
                                    <td>{{$purchase->total}}</td>
                                    <td>{{$purchase->less}}</td>
                                    <td>{{$purchase->payment}}</td>
                                    <td>{{$purchase->dues}}</td>

                                    <td>
                                        <a href="../feedpurchases/{{$purchase->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    @if($user == 'admin')
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        {!! Form::open(['method'=> 'DELETE', 'route'=>['feedpurchases.destroy', $purchase->id]]) !!}
                                        {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                                        {!! Form::close() !!}</a>
                                    </td>
                                        @endif
                                </tr>
                            @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection