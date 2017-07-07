@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <div class="panel panel-default">
                    <div class="panel-heading">
                        <div class="row sales_heading">
                            <div class="col-md-3 col-print-12">
                                <strong>{{$customer->name}}</strong>
                            </div>
                            <div class="col-md-1 hidden-print">
                                <a href="{{$customer->id}}/edit"><span class="glyphicon glyphicon-edit pull-right"></span></a>
                            </div>
                           <div class="col-md-6"></div>
                            <div class="col-md-2 hidden-print">
                                <ul class="nav navbar-nav">
                                    <li class="dropdown">
                                        <a class="dropdown-toggle" data-toggle="dropdown" href="#"><i class="fa fa-mail-forward"></i> Export <span class="caret"></span></a>
                                        <ul class="dropdown-menu">
                                            <li><a href="#" id="excel" class="excel"><i class="fa fa-file-excel-o"></i> To Excel</a></li>
                                            <li><a href="#" class="word"><i class="fa fa-file-word-o"></i> To Word</a></li>
                                            <li><a href="#"  onclick="printInvoice()" class="print_page"><i class="fa fa-file-word-o"></i> To Print</a></li>
                                            <li><a href="#" class="pdf"><i class="fa fa-file-pdf-o"></i> To PDF</a></li>
                                        </ul>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="panel-body">
                        @if (Session::has('message'))
                            <div class="alert alert-info">{{ Session::get('message') }}</div>
                        @endif
                        <div class="col-md-6 col-md-offset-2">
                            <img class="img-responsive hidden-print" src="../{{$customer->image}}" alt=""><br>
                            <div class="text-left">
                                <strong>Address : </strong>  {{$customer->address}}<br>
                                <strong>Phone : </strong> {{$customer->phone}}<br>
                            </div>
                        </div>
                        <div class="col-md-4 col-print-12 hidden-print">
                            <h4><strong>Previous Balance : <span class="navy">Tk.{{ number_format($customer->balance, 2)}}</span></strong></h4>
                            <h4><strong>Total Sales : <span class="navy">Tk.{{number_format(DB::table('sales')->where('customer_id', $customer->id)->sum('total') + $customer->balance, 2)}}</span></strong></h4>
                            <h4><strong>Total Payment : <span class="navy">Tk.{{number_format(DB::table('sales')->where('customer_id', $customer->id)->sum('payment') + $customer->payment, 2)}}</span></strong></h4>
                            <h4><strong>Balnce/Dues : <span class="red">Tk.{{round(DB::table('sales')->where('customer_id', $customer->id)->sum('dues') + $customer->balance, 2) }}</span></strong></h4>
                        </div>
                        <div class="clearfix"></div>
                        <div class="row hidden-print"  style="margin-top: 30px">
                            <div class="col-md-2">
                                <h4><Strong>Sales List:</Strong></h4>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-inline">
                                    <label for="StartDate">From</label>
                                    <input type="text" name="StartDate" id="StartDate" class="form-control" required />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group form-inline">
                                    <label for="EndDate">To</label>
                                    <input type="text" name="EndDate" id="EndDate" class="form-control" required />
                                </div>
                            </div>
                        </div>
                        <div id="list-sale-report">
                        @if(count($sales))

                        <table class="table table-bordered table-striped table-hover">
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
                            <tbody>
                            @foreach($sales as $sale)
                                <tr>
                                    <td>{{$sale->id}}</td>
                                    <td>{{$sale->created_at->format('d-m-Y')}}</td>
                                    <td>{{$sale->updated_at->format('d-m-Y')}}</td>
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
                                    @if($user=='admin')
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
                        @endif
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
                var CustomerId = "{{$customer->id}}";

                listSales(DateCreated,EndDate, CustomerId);
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
                var CustomerId = "{{$customer->id}}";

                listSales(DateCreated,EndDate, CustomerId);
            }
        });
        function listSales(criteria1, criteria2, criteria3)
        {
            $.ajax({
                type : 'get',
                url : "{!! url('/birds/customers/getsales') !!}",
                data : {DateCreated:criteria1,EndDate:criteria2, CustomerId:criteria3},
                success:function(data)
                {
                    $('#list-sale-report').empty().html(data);
                }
            })
        }

        $('.pdf').on('click', function(e){
            var doc = new jsPDF('p', 'pt');
            doc.setFontSize(10);
            doc.text("Customer Name : {{$customer->name}} " +
                    "Balnce/Dues : Tk.{{round(DB::table('sales')->where('customer_id', $customer->id)->sum('total') + $customer->balance -DB::table('sales')->where('customer_id', $customer->id)->sum('payment') - $customer->payment, 2) }} "+ new Date(), 40, 50);
            var res = doc.autoTableHtmlToJson(document.getElementById("list-sale-report"));
            doc.autoTable(res.columns, res.data, {
                theme : 'grid',
                startY:60,
            });
            doc.save("Salereport" + new Date().toISOString().replace(/[\-\:\.]/g, "")+'.pdf')
        })
        function printInvoice() {
            window.print();
        }
    </script>
@endsection