@extends('layouts.app')

@section('content')
    <div class="">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row">
                            <div class="col-md-2">
                                List of Expenses
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
                                <a href="expenses/create"><span class="glyphicon glyphicon-plus pull-right"></span></a>
                            </div>
                        </div>
                    </div>

                    <div class="panel-body" id="list-of-expenses" >
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <table class="table table-bordered table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Created At</th>
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
                                    <td>{{$expense->created_at->format('d-m-Y')}}</td>
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
                url : "{!! url('/getexpense') !!}",
                data : {DateCreated:criteria1,EndDate:criteria2},
                success:function(data)
                {
                    $('#list-of-expenses').empty().html(data);
                }
            })
        }

    </script>
@endsection