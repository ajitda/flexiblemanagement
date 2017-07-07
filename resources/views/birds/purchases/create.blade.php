@extends("layouts.app")
@section("content")
    {!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
    {!! Html::script('js/purchase.js', array('type' => 'text/javascript')) !!}
<div class="panel panel-default" ng-app="purchaseApp">
    <div class="panel-heading">Create New Purchase</div>
    <div class="panel-body" ng-controller="purchaseController">
        {!! Form::open(['route'=>'purchases.store', 'files'=>true]) !!}
            <div class="form-group col-md-4">
                <label for="supplier_name">Select a Supplier Name : </label>
                {!! Form::select('supplier_id', $suppliers, null, array('required', 'class'=> 'form-control', 'id'=> 'supplier_name', 'placeholder'=>'Select a supplier')) !!}
            </div>
            <div class="clearfix"></div>

            <div class="form-group col-md-2">
                <label for="qty" >Quantity : </label>
                {!! Form::number('qty', null, array('required', 'id'=> 'qty', 'class' => 'form-control', 'ng-model'=>'qty')) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="weight" >Weight (Kg ) : </label>
                {!! Form::number('weight', null, array('required', 'step' => 'any', 'id'=> 'weight', 'class' => 'form-control', 'ng-model'=>'weight')) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="tweight" >Total Weight (Kg ) : </label>
                {!! Form::number('tweight', null, array('required', 'step' => 'any', 'id'=> 'tweight', 'class' => 'form-control', 'ng-model'=>'tweight')) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="price_per_kg">Price Per Kg (Tk.): </label>
                {!! Form::number('price_per_kg', null, array('required', 'step' => 'any','id'=> 'price_per_kg', 'class' => 'form-control', 'ng-model'=>'price_per_kg')) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="death_qty">Death Qty : </label>
                {!! Form::number('death_qty', null, array('required', 'id'=> 'death_qty', 'class' => 'form-control', 'ng-model'=>'death_qty')) !!}
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-md-2">
                <label for="sub_total">Subtotal : </label>
                <div class="sub_total_text"><span data-ng-bind=" tweight * price_per_kg  | currency"></span></div>
            </div>
            <div class="form-group col-md-2">
                <label for="transport"> Transport Cost (Tk) : </label>
                {!! Form::number('transport', null, array('required', 'id'=> 'transport', 'class' => 'form-control', 'ng-model'=>'transport')) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="daily_stuff_salary">Daily Stuff Salary : </label>
                {!! Form::number('daily_stuff_salary', null, array('required', 'id'=> 'daily_stuff_salary', 'class' => 'form-control', 'ng-model'=>'daily_stuff_salary')) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="others">Others (Tk.) : </label>
                {!! Form::number('others', null, array('required', 'id'=> 'others', 'class' => 'form-control', 'ng-model'=>'others')) !!}
            </div>
            <div class="clearfix"></div>
            <div class="form-group col-md-2">
                <label for="total">Total : </label>
                <div class="sub_total_text">
                    <span data-ng-bind=" tweight * price_per_kg + transport+daily_stuff_salary+others | currency"></span>
                </div>
            </div>
            <div class="form-group col-md-2">
                <label for="less">Less : </label>
                {!! Form::number('less', null, array('required', 'step'=>'any', 'class'=>'form-control', 'ng-model'=>'less')) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="payment">Payment : </label>
                {!! Form::number('payment', null, array('required', 'id'=>"payment",'class'=>'form-control', 'ng-model'=> 'payment')) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="dues">Dues : </label>
                <div class="sub_total_text">
                    <span data-ng-bind=" tweight * price_per_kg + transport+daily_stuff_salary+others-less-payment | currency"></span>
                </div>
            </div>
            <div class="clearfix"></div>
            <div class="col-md-2 form-group">
                {!! Form::submit('Complete', array('class'=> 'btn btn-primary complete-btn')) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection