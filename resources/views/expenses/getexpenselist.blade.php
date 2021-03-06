<table class="table table-bordered table-striped table-hover" id="list-of-expenses">
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
    @if(count($expenses))
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
        @endif
    </tbody>
</table>