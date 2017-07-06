@extends("layouts.app")
@section("content")
    {!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
    {!! Html::script('js/purchase.js', array('type' => 'text/javascript')) !!}
    <div class="panel panel-default" ng-app="purchaseApp" >
        <div class="panel-heading">Edit Purchase</div>
        <div class="panel-body" ng-controller="purchaseController">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            {!! Form::model($purchase, ['method'=>'PATCH', 'action'=>['PurchasesController@update', $purchase], 'files'=>true]) !!}
                <div class="form-group col-md-4">
                    <label for="supplier_name">Select a Supplier Name : </label>
                    {!! Form::select('supplier_id', $suppliers, null, array('required', 'class'=> 'form-control', 'id'=> 'supplier_name', 'placeholder'=>'Select a supplier')) !!}
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-2">
                    <label for="qty" >Enter Quantity : </label>
                    {!! Form::number('qty', null, array('required', 'id'=> 'qty', 'class' => 'form-control', 'ng-model'=>'qty', 'ng-init'=>"qty='$purchase->qty'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="weight" >Enter Weight (Kg ) : </label>
                    {!! Form::number('weight', null, array('required', 'step' => 'any', 'id'=> 'weight', 'class' => 'form-control', 'ng-model'=>'weight','ng-init'=>"weight='$purchase->weight'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="tweight" >Enter Weight (Kg ) : </label>
                    {!! Form::number('tweight', null, array('required', 'step' => 'any', 'id'=> 'weight', 'class' => 'form-control', 'ng-model'=>'tweight','ng-init'=>"tweight='$purchase->tweight'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="price_per_kg">Enter Price Per Kg (Tk.): </label>
                    {!! Form::number('price_per_kg', null, array('required', 'step' => 'any','id'=> 'price_per_kg', 'class' => 'form-control', 'ng-model'=>'price_per_kg','ng-init'=>"price_per_kg='$purchase->price_per_kg'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="death_qty">Enter Death Qty : </label>
                    {!! Form::number('death_qty', null, array('required', 'id'=> 'death_qty', 'class' => 'form-control', 'ng-model'=>'death_qty', 'ng-init'=>"death_qty='$purchase->death_qty'")) !!}
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-2">
                    <label for="sub_total">Subtotal : </label>
                    <div class="sub_total_text"><span data-ng-bind="tweight * price_per_kg - (death_qty* weight * price_per_kg) | currency"></span></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="transport"> Transport Cost (Tk.) : </label>
                    {!! Form::number('transport', null, array('required', 'id'=> 'transport', 'class' => 'form-control', 'ng-model'=>'transport', 'ng-init'=>"transport='$purchase->transport'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="daily_stuff_salary">Daily Stuff Salary (Tk.) : </label>
                    {!! Form::number('daily_stuff_salary', null, array('required', 'id'=> 'daily_stuff_salary', 'class' => 'form-control', 'ng-model'=>'daily_stuff_salary', 'ng-init'=>"daily_stuff_salary='$purchase->daily_stuff_salary'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="others">Others (Tk.) : </label>
                    {!! Form::number('others', null, array('required', 'id'=> 'others', 'class' => 'form-control', 'ng-model'=>'others', 'ng-init'=>"others='$purchase->others'")) !!}
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-2">
                    <label for="total">Total : </label>
                    <div class="sub_total_text"><span data-ng-bind="tweight * price_per_kg - (death_qty* weight * price_per_kg)+cost() | currency"></span></div>
                </div>
                <div class="form-group col-md-2">
                    <label for="less">Less (Tk.) : </label>
                    {!! Form::number('less', null, array('required', 'step'=>'any','id'=> 'less', 'class' => 'form-control', 'ng-model'=>'less', 'ng-init'=>"less='$purchase->less'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="payment">Payment : </label>
                    {!! Form::number('payment', null, array('required', 'class'=>'form-control', 'ng-model'=> 'payment', 'ng-init'=>"payment='$purchase->payment'")) !!}
                </div>
                <div class="form-group col-md-2">
                    <label for="total">Dues : </label>
                    <div class="sub_total_text"><span data-ng-bind="tweight * price_per_kg - (death_qty* weight * price_per_kg)+cost()- payment - less | currency"></span></div>
                </div>
                <div class="clearfix"></div>
                <div class="col-md-2 form-group">
                    {!! Form::submit('Update', array('class'=> 'btn btn-primary complete-btn')) !!}
                </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection