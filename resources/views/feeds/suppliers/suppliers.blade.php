@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Suppliers
                        <a href="feedsuppliers/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                    </div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Supplier</th>
                                    <th>Address</th>
                                    <th>Image</th>
                                    <th>Phone</th>
                                    <th>User</th>
                                    @if($user == 'admin')
                                    <th colspan="2">Actions</th>
                                        @else
                                        <th>Actions</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($suppliers as $supplier)
                                <tr>
                                    <td>{{$supplier->id}}</td>
                                    <td><a href="feedsuppliers/{{$supplier->id}}">{{$supplier->supplier_name}}</a></td>
                                    <td>{{$supplier->address}}</td>
                                    <td><img class="img-responsive img-small" src="{{$supplier->image}}" alt=""></td>
                                    <td>{{$supplier->phone}}</td>
                                    <td>{{$supplier->user->name}}</td>
                                    <td>
                                        <a href="feedsuppliers/{{$supplier->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    @if($user == 'admin')
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        {!! Form::open(['method'=> 'DELETE', 'route'=>['feedsuppliers.destroy', $supplier->id]]) !!}
                                        {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                                        {!! Form::close() !!}</a>
                                    </td>
                                        @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            {!! $suppliers->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection