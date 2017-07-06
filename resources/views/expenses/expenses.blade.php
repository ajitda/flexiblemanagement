@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Expenses
                        <a href="expenses/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                    </div>

                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Category</th>
                                    <th>Description</th>
                                    <th>Qty</th>
                                    <th>Unit Amount</th>
                                    <th>Total Amount</th>
                                    <th>Created By</th>
                                    @if($user == 'admin')
                                    <th colspan="2">Actions</th>
                                        @else
                                        <th>Action</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($expenses as $expense)
                                <tr>
                                    <td>{{$expense->id}}</td>
                                    <td>{{$expense->expense_category->name }}</td>
                                    <td>{{$expense->description}}</td>
                                    <td>{{$expense->qty }}</td>
                                    <td>{{$expense->unit_expense }}</td>
                                    <td>{{$expense->total}}</td>
                                    <td>{{$expense->user->name}}</td>

                                    <td>
                                        <a href="expenses/{{$expense->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                    </td>
                                    @if($user == 'admin')
                                    <td><a href="#" onclick="return confirm('are you sure?')">
                                        {!! Form::open(['method'=> 'DELETE', 'route'=>['expenses.destroy', $expense->id]]) !!}
                                        {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                                        {!! Form::close() !!}</a>
                                    </td>
                                        @endif
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="paginatios col-lg-12">
                            {!! $expenses->render() !!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection