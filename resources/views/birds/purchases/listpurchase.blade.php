<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Created at</th>
        <th>Suppliers</th>
        <th>Qty</th>
        <th>Weight</th>
        <th>Total Weight</th>
        <th>Price Per Kg</th>
        <th>Subtotal</th>
        <th>Death Qty</th>
        <th>Transport</th>
        <th>Daily Stuff</th>
        <th>Others</th>
        <th>Total</th>
        <th>Less</th>
        <th>Payment</th>
        <th>Dues</th>
        @if($user=='admin')
            <th colspan="2">Actions</th>
        @else
            <th>Actions</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($purchases as $purchase)
        <tr>
            <td>{{$purchase->id}}</td>
            <td>{{$purchase->created_at->format('Y-m-d')}}</td>
            <td>{{$purchase->supplier->supplier_name}}</td>
            <td>{{$purchase->qty}}</td>
            <td>{{$purchase->weight}}</td>
            <td>{{$purchase->tweight}}</td>
            <td>{{$purchase->price_per_kg}}</td>
            <td>{{$purchase->sub_total}}</td>
            <td>{{$purchase->death_qty}}</td>
            <td>{{$purchase->transport}}</td>
            <td>{{$purchase->daily_stuff_salary}}</td>
            <td>{{$purchase->others}}</td>
            <td>{{$purchase->total}}</td>
            <td>{{$purchase->less}}</td>
            <td>{{$purchase->payment}}</td>
            <td>{{$purchase->dues}}</td>

            <td>
                <a href="purchases/{{$purchase->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            @if($user=='admin')
                <td><a href="#" onclick="return confirm('are you sure?')">
                    {!! Form::open(['method'=> 'DELETE', 'route'=>['purchases.destroy', $purchase->id]]) !!}
                    {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                    {!! Form::close() !!}</a>
                </td>
            @endif
        </tr>
    @endforeach
    </tbody>
</table>