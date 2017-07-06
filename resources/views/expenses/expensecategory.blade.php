@extends('layouts.app')
@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">Expense Categories</div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <ul class="list-inline">
                            @foreach($expense_category as $category)
                                <li class="list-group-item list-group-item-info"><a href="{{ route('expensecategory.show', $category->id) }}">{{$category->name}}</a></li>
                                @endforeach
                                <li><a href="#modal-id" data-toggle="modal">Add New Expense Category</a></li>
                        </ul>
                        <div class="modal fade" id="modal-id">
                            <div class="modal-dialog">
                                {!! Form::open(['route' => 'expensecategory.store', 'method' => 'post']) !!}
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                        <h4 class="modal-title">Add A Expense Category</h4>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            {{ Form::label('name', 'Name') }}
                                            {{ Form::text('name', null, array('class' => 'form-control')) }}
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save Changes</button>
                                    </div>
                                </div>
                                {!! Form::close() !!}
                            </div>
                        </div>

                        <div>
                            @if(!empty($expensecategoryitem))
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
                                            <th colspan="2">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    @forelse($expensecategoryitem as $single)

                                        <tr>
                                            <td>{{$single->id}}</td>
                                            <td>{{$single->expense_category->name}}</td>
                                            <td>{{$single->description}}</td>
                                            <td>{{$single->qty }}</td>
                                            <td>{{$single->unit_expense }}</td>
                                            <td>{{$single->total}}</td>
                                            <td>{{$single->user->name}}</td>

                                            <td>
                                                <a href="../expenses/{{$single->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
                                            </td>
                                            <td>
                                                {!! Form::open(['method'=> 'DELETE', 'route'=>['expenses.destroy', $single->id]]) !!}
                                                {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                                                {!! Form::close() !!}
                                            </td>
                                        </tr>
                                    @empty
                                        <tr><td>No Data</td></tr>
                                    @endforelse
                                    </tbody>
                                </table>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </div>
    @endsection