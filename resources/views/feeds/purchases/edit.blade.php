@extends("layouts.app")
@section("content")
    {!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
    {!! Html::script('js/purchase.js', array('type' => 'text/javascript')) !!}
    <div class="panel panel-default" ng-app="purchaseApp" >
        <div class="panel-heading">Edit Feed Purchase</div>
        <div class="panel-body" ng-controller="purchaseController">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            {!! Form::model($purchase, ['method'=>'PATCH', 'action'=>['FeedPurchaseController@update', $purchase], 'files'=>true]) !!}
                <div class="form-group col-md-4">
                    <label for="supplier_name">Select a Supplier Name : </label>
                    {!! Form::select('feed_supplier_id', $suppliers, null, array('required', 'class'=> 'form-control', 'id'=> 'supplier_name', 'placeholder'=>'Select a supplier')) !!}
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-2">
                    <label for="qty" >Enter Quantity : </label>
                    {!! Form::number('qty', null, array('required', 'id'=> 'qty', 'class' => 'form-control', 'ng-model'=>'qty', 'ng-init'=>"qty='$purchase->qty'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="unit_price" >Enter Weight (Kg ) : </label>
                    {!! Form::number('unit_price', null, array('required', 'step' => 'any', 'id'=> 'unit_price', 'class' => 'form-control', 'ng-model'=>'unit_price','ng-init'=>"unit_price='$purchase->unit_price'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="sub_total">Subtotal : </label>
                    <div class="sub_total_text"><span data-ng-bind="qty * unit_price | currency"></span></div>
                </div>

                <div class="form-group col-md-2">
                    <label for="costing">Costing : </label>
                    {!! Form::number('costing', null, array('required', 'id'=> 'costing', 'class' => 'form-control', 'ng-model'=>'costing', 'ng-init'=>"costing='$purchase->costing'")) !!}
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-2">
                    <label for="total">Total : </label>
                    <div class="sub_total_text"><span data-ng-bind="costings() | currency"></span></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="less">Less : </label>
                    {!! Form::number('less', null, array('required', 'id'=> 'less','step'=>'any', 'class' => 'form-control', 'ng-model'=>'less', 'ng-init'=>"less='$purchase->less'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="payment">Payment : </label>
                    {!! Form::number('payment', null, array('required', 'step'=>'any', 'class'=>'form-control', 'ng-model'=> 'payment', 'ng-init'=>"payment='$purchase->payment'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="dues">Dues : </label>
                    <div class="sub_total_text"><span data-ng-bind="costings()-payment - less | currency"></span></div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-2 form-group">
                    {!! Form::submit('Feed Purchase Update', array('class'=> 'btn btn-primary complete-btn')) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection