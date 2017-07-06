@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Chick Customers
                        <a href="chickcustomers/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Customer</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Phone</th>
                                    <th>created By</th>
                                    <th>Balance</th>
                                    <th>Payment</th>
                                    <th>Dues</th>
                                    @if($user=='admin')
                                    <th colspan="3">Actions</th>
                                        @else
                                    <th>Actions</th>
                                        @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->id}}</td>
                                    <td><a href="chickcustomers/{{$customer->id}}">{{$customer->name}}</a></td>
                                    <td>{{$customer->address}}</td>
                                    <td><img class="img-responsive img-small" src="{{$customer->image}}" alt=""></td>
                                    <td>{{$customer->phone}}</td>
                                    <td>{{$customer->user->name}}</td>
                                    <td>{{number_format(DB::table('chick_sales')->where('chick_customer_id', $customer->id)->sum('total') + $customer->balance, 2)}}</td>
                                    <td>{{number_format(DB::table('chick_sales')->where('chick_customer_id', $customer->id)->sum('payment') + $customer->payment, 2)}}</td>
                                    <td>{{round(DB::table('chick_sales')->where('chick_customer_id', $customer->id)->sum('total') + $customer->balance -DB::table('chick_sales')->where('chick_customer_id', $customer->id)->sum('payment') - $customer->payment, 2) }}</td>


                                    <td>
                                        <a href="chickcustomers/{{$customer->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    @if($user=='admin')
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        {!! Form::open(['method'=> 'DELETE', 'route'=>['chickcustomers.destroy', $customer->id]]) !!}
                                        {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                                        {!! Form::close() !!}</a>
                                    </td>
                                    @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            {!! $customers->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection