<table class="table table-bordered table-striped table-hover" id="list-sale-report">
    <thead>
    <tr>
        <th>ID</th>
        <th>Created at</th>
        <th>Updated at</th>
        <th class="hidden-print">Suppliers</th>
        <th>Qty</th>
        <th>Weight</th>
        <th>Price Per Kg</th>
        <th>Subtotal</th>
        <th>Death Qty</th>
        <th>Total</th>
        <th>Less</th>
        <th>Payment</th>
        <th>Dues</th>
        @if($user=='admin')
        <th colspan="2" class="hidden-print">Actions</th>
        @else
        <th class="hidden-print">Actions</th>
        @endif
    </tr>
    </thead>
    @if(count($sales))
    <tbody class="list-sale-report">
    @foreach($sales as $sale)
        <tr>
            <td>{{$sale->id}}</td>
            <td>{{$sale->created_at}}</td>
            <td>{{$sale->updated_at}}</td>
            <td class="hidden-print">{{$sale->supplier->supplier_name}}</td>
            <td>{{$sale->qty}}</td>
            <td>{{$sale->weight}}</td>
            <td>{{$sale->price_per_kg}}</td>
            <td>{{$sale->sub_total}}</td>
            <td>{{$sale->death_qty}}</td>

            <td>{{$sale->total}}</td>
            <td>{{$sale->less}}</td>
            <td>{{$sale->payment}}</td>
            <td>{{$sale->dues}}</td>

            <td class="hidden-print">
                <a href="../sales/{{$sale->id}}/edit"><span class="glyphicon glyphicon-edit"></span></a>
            </td>
            @if($user =='admin')
            <td class="hidden-print"><a href="#" onclick="return confirm('are you sure?')">
                {!! Form::open(['method'=> 'DELETE', 'route'=>['sales.destroy', $sale->id]]) !!}
                {!! Form::submit('X', ['class'=> 'btn btn-danger btn-small']) !!}
                {!! Form::close() !!}</a>
            </td>
                @endif
        </tr>
    @endforeach
    </tbody>
</table>
<div class="row">
    <div class="col-sm-4 col-sm-offset-8">
        <table class="table table-bordered table-hover table-striped pull-right">
            <tr>
                <td>Previous Balance :</td>
                <td>{{DB::table('sales')->where('customer_id', $customer->id)->sum('dues')- DB::table('sales')->where('customer_id', $customer->id)->whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->sum('dues') + $customer->balance}}</td>
            </tr>
            <tr>
                <td>Total Sales :</td>
                <td>{{DB::table('sales')->where('customer_id', $customer->id)->whereBetween('created_at', [ $request->DateCreated.' 00:00:00', $request->EndDate.' 23:59:59'])->sum('dues')}}</td>
            </tr>
            <tr>
                <td>Total Dues : </td>
                <td>{{DB::table('sales')->where('customer_id', $customer->id)->sum('dues') + $customer->balance}}</td>
            </tr>
            <tr>
                <td>Payment : </td>
                <td></td>
            </tr>
            <tr>
                <td>Dues : </td>
                <td></td>
            </tr>
        </table>
    </div>
</div>

@endif