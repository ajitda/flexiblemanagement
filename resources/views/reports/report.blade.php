<table class="table table-bordered table-striped table-hover">
    <thead>
    <tr>
        <th>Income Source</th>
        <th>Expense Source</th>
        <th>Debit</th>
        <th>Credit</th>
        <th>Balance</th>
    </tr>
    </thead>
    <tbody>
@if(count($balance))
    <tr>
        <td>Previous Balance</td>
        <td></td>
        <td></td>
        <td></td>
        <td>
            {{
            number_format($balance-(DB::table('sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('chick_sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('feed_sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment')-
            DB::table('purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') -
            DB::table('chick_purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') -
            DB::table('feed_purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') -
            DB::table('expenses')->whereDate('updated_at', '=', $request->DateCreated)->sum('total')))
            }}
        </td>
        </tr>
        {{--get daily sales for birds--}}

        @foreach($birdsales as $birdsale)
            @if($birdsale->payment > '0.00')
                <tr>
                    <td>{{$birdsale->customer->name}}</td>
                    <td></td>
                    <td>{{$birdsale->payment}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        @endforeach
        {{--get daily sales for feed--}}
        @foreach($feedsales as $feedsale)
            @if($feedsale->payment > '0.00')
                <tr>
                    <td>{{$feedsale->feed_customer->name}}</td>
                    <td></td>
                    <td>{{$feedsale->payment}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        @endforeach
        {{--get daily sales for chicks--}}
        @foreach($chicksales as $chicksale)
            @if($chicksale->payment > '0.00')
                <tr>
                    <td>{{$chicksale->chick_customer->name}}</td>
                    <td></td>
                    <td>{{number_format($chicksale->payment)}}</td>
                    <td></td>
                    <td></td>
                </tr>
            @endif
        @endforeach
        {{--get daily purchases for birds--}}
        @foreach($birdpurchases as $birdpurchase)
            @if($birdpurchase->payment > '0.00')
                <tr>
                    <td></td>
                    <td>{{$birdpurchase->supplier->supplier_name}}</td>
                    <td></td>
                    <td>{{number_format($birdpurchase->payment)}}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach
        {{--get daily purchases for chicks--}}
        @foreach($chickpurchases as $chickpurchase)
            @if($chickpurchase->payment > '0.00')
                <tr>
                    <td></td>
                    <td>{{$chickpurchase->chick_supplier->supplier_name}}</td>
                    <td></td>
                    <td>{{number_format($chickpurchase->payment)}}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach
        {{--get daily purchases for feed--}}
        @foreach($feedpurchases as $feedpurchase)
            @if($feedpurchase->payment > '0.00')
                <tr>
                    <td></td>
                    <td>{{$feedpurchase->feed_supplier->supplier_name}}</td>
                    <td></td>
                    <td>{{number_format($feedpurchase->payment)}}</td>
                    <td></td>
                </tr>
            @endif
        @endforeach
        {{--get daily expenses--}}
        @foreach($expenses as $expense)
            <tr>
                <td></td>
                <td>{{$expense->description.' - '.$expense->expense_category->name}}</td>
                <td></td>
                <td>{{number_format($expense->total)}}</td>
                <td></td>
            </tr>
        @endforeach
        <tr>
        <td>Total</td>
        <td></td>
        <td>
            {{number_format(DB::table('sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('chick_sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('feed_sales')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment'))}}
        </td>
        <td>
            {{number_format(DB::table('purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('chick_purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('feed_purchases')->whereDate('updated_at', '=', $request->DateCreated)->sum('payment') +
            DB::table('expenses')->whereDate('updated_at', '=', $request->DateCreated)->sum('total'))}}
        </td>
        <td>
            {{number_format($balance)}}
        </td>
    </tr>
        @endif
    </tbody>
</table>
{{--
DB::table('sales')->whereDate('created_at', '=', $request->DateCreated)->sum('payment') +
DB::table('chick_sales')->whereDate('created_at', '=', $request->DateCreated)->sum('payment') +
DB::table('feed_sales')->whereDate('created_at', '=', $request->DateCreated)->sum('payment')-
DB::table('purchases')->whereDate('created_at', '=', $request->DateCreated)->sum('payment') -
DB::table('chick_purchases')->whereDate('created_at', '=', $request->DateCreated)->sum('payment') -
DB::table('feed_purchases')->whereDate('created_at', '=', $request->DateCreated)->sum('payment') -
DB::table('expenses')->whereDate('created_at', '=', $request->DateCreated)->sum('total')--}}
