@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <h3 class="text-center visible-print">All Customer Daily Balance Sheet</h3>
                    <div class="text-center visible-print">Date : {{\Carbon\Carbon::today()}}</div>
                    <div class="panel-heading hidden-print">Customers
                        <a href="customers/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
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
                                    <th class="hidden-print">Address</th>
                                    <th class="hidden-print">Image</th>
                                    <th class="hidden-print">Phone</th>
                                    <th class="hidden-print">created By</th>
                                    <th>Prvious Balance</th>
                                    <th>Daily Sale</th>
                                    <th>Daily Payment</th>
                                    <th>Net Balance</th>
                                    @if($user == 'admin')
                                    <th colspan="3" class="hidden-print">Actions</th>
                                        @else
                                        <th class="hidden-print">Actions</th>
                                        @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($customers as $customer)
                                <tr>
                                    <td>{{$customer->id}}</td>
                                    <td><a href="customers/{{$customer->id}}">{{$customer->name}}</a></td>
                                    <td class="hidden-print">{{$customer->address}}</td>
                                    <td class="hidden-print"><img class="img-responsive img-small" src="{{$customer->image}}" alt=""></td>
                                    <td class="hidden-print">{{$customer->phone}}</td>
                                    <td class="hidden-print">{{$customer->user->name}}</td>
                                    <td>{{number_format(DB::table('sales')->whereDate('created_at', '<=', \Carbon\Carbon::yesterday())->where('customer_id', $customer->id)->sum('dues') + $customer->balance - $customer->payment, 2)}}</td>
                                    <td>{{number_format(DB::table('sales')->whereDate('created_at', '=', \Carbon\Carbon::today())->where('customer_id', $customer->id)->sum('total') , 2)}}</td>
                                    <td>{{round(DB::table('sales')->whereDate('created_at', '=', \Carbon\Carbon::today())->where('customer_id', $customer->id)->sum('payment'), 2) }}</td>
                                    <td>{{round(DB::table('sales')->where('customer_id', $customer->id)->sum('dues') + $customer->balance - $customer->payment, 2) }}</td>


                                    <td class="hidden-print">
                                        <a href="customers/{{$customer->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    @if($user=='admin')
                                    <td class="hidden-print"><a href="#" onclick="return confirm('are you sure?')">
                                        {!! Form::open(['method'=> 'DELETE', 'route'=>['customers.destroy', $customer->id]]) !!}
                                        {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                                        {!! Form::close() !!}</a>
                                    </td>
                                        @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="paginatios col-md-12 hidden-print">
                            {!! $customers->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection