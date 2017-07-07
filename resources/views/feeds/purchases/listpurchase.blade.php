<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>ID</th>
        <th>Created At</th>
        <th>Suppliers</th>
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
            <th>Action</th>
        @endif
    </tr>
    </thead>
    <tbody>
    @foreach($purchases as $purchase)
        <tr>
            <td>{{$purchase->id}}</td>
            <td>{{$purchase->created_at->format('d-m-Y')}}</td>
            <td>{{$purchase->feed_supplier->supplier_name}}</td>
            <td>{{$purchase->qty}}</td>
            <td>{{$purchase->unit_price}}</td>
            <td>{{$purchase->sub_total}}</td>
            <td>{{$purchase->costing}}</td>
            <td>{{$purchase->total}}</td>
            <td>{{$purchase->less}}</td>
            <td>{{$purchase->payment}}</td>
            <td>{{$purchase->dues}}</td>

            <td>
                <a href="feedpurchases/{{$purchase->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
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