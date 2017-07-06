<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>Date</th>
        <th>Purchase</th>
        <th>Expense</th>
        <th>Less</th>
        <th>Cost</th>
        <th>Total Sale</th>
        <th>Cheque Sale & Others</th>
        <th>Cash Sale</th>
        <th>Collection</th>
        <th>Balance</th>
        <th>Profit</th>
    </tr>
    </thead>
    @if(count($reportsummarys))
    <tbody>
    @foreach($reportsummarys as $reportsummary)
        <tr>
            <td>{{$reportsummary->created_at}}</td>
            <td>{{$reportsummary->total_purchase }}</td>
            <td>{{$reportsummary->total_expense}}</td>
            <td>{{$reportsummary->total_less }}</td>
            <td>{{$reportsummary->total_cost }}</td>
            <td>{{$reportsummary->total_sale}}</td>
            <td>{{$reportsummary->cheque_sale_others}}</td>
            <td>{{$reportsummary->cash_sale}}</td>
            <td>{{$reportsummary->collection}}</td>
            <td>{{$reportsummary->balance}}</td>
            <td>{{$reportsummary->profit}}</td>

            {{--<td>--}}
            {{--<a href="expenses/{{$reportsummary->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>--}}
            {{--</td>--}}
            {{--<td>--}}
            {{--{!! Form::open(['method'=> 'DELETE', 'route'=>['expenses.destroy', $expense->id]]) !!}--}}
            {{--{!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}--}}
            {{--{!! Form::close() !!}--}}
            {{--</td>--}}
        </tr>
    @endforeach
    </tbody>
        @endif
</table>