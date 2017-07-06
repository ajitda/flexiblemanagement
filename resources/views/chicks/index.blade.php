@extends('layouts.app')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">Chicks Summary</div>

                <div class="panel-body">
                    {{--{{ trans('dashboard.welcome') }}--}}
                    {{--<h3 class="panel-title">Statistics</h3>--}}
                    <br />

                    <div class="row">
                        <div class="col-md-4">
                            <div class="purple well"><i class="fa fa-shopping-cart" aria-hidden="true"></i><br>

                                <span><strong>{{trans('dashboard.total_earnings')}} : {{number_format($total_earning, 2)}}</strong></span></div>
                        </div>
                        <div class="col-md-4">
                            <div class="chocolate well"><i class="fa fa-sitemap" aria-hidden="true"></i><br>

                                <span><strong>{{trans('dashboard.total_cost')}} : {{number_format($total_cost, 2)}}</strong></span></div>
                        </div>
                        <div class="col-md-4">
                            <div class="well yellow"><i class="fa fa-cubes" aria-hidden="true"></i><br>
                                <span><strong>{{trans('dashboard.total_profit')}} : {{number_format($total_earning - $total_cost, 2)}}</strong></span></div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="well green"><i class="fa fa-bars" aria-hidden="true"></i><br>
                                <span><strong>{{trans('dashboard.total_purchases')}} : {{$purchases}}</strong></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="well blue"><i class="fa fa-list" aria-hidden="true"></i><br>
                                <span><strong>{{trans('dashboard.total_sales')}} : {{$sales}}</strong></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="violet well"><i class="fa fa-users" aria-hidden="true"></i><br>
                                <span><strong>{{trans('dashboard.total_customers')}} : {{$customers}}</strong></span></div>
                        </div>
                        <div class="col-md-3">
                            <div class="brown well"><i class="fa fa-user" aria-hidden="true"></i><br>
                                <span><strong>{{trans('dashboard.total_suppliers')}} : {{$suppliers}}</strong></span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
