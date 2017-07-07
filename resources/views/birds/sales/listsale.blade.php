<table class="table table-bordered table-striped table-hover" id="list-sale-report">
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
    @if(count($sales))
    <tbody class="list-sale-report">
    @foreach($sales as $sale)
        <tr>
            <td>{{$sale->id}}</td>
            <td>{{$sale->created_at->format('d-m-Y')}}</td>
            <td>{{$sale->supplier->supplier_name}}</td>
            <td>{{$sale->qty}}</td>
            <td>{{$sale->weight}}</td>
            <td>{{$sale->tweight}}</td>
            <td>{{$sale->price_per_kg}}</td>
            <td>{{$sale->sub_total}}</td>
            <td>{{$sale->death_qty}}</td>

            <td>{{$sale->total}}</td>
            <td>{{$sale->less}}</td>
            <td>{{$sale->payment}}</td>
            <td>{{$sale->dues}}</td>

            <td>
                <a href="../sales/{{$sale->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            @if($user == 'admin')
            <td><a href="#" onclick="return confirm('are you sure?')">
                {!! Form::open(['method'=> 'DELETE', 'route'=>['sales.destroy', $sale->id]]) !!}
                {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                {!! Form::close() !!}</a>
            </td>
                @endif
        </tr>
    @endforeach
    </tbody>
        @endif
</table>