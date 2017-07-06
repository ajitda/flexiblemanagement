@extends("layouts.app")
@section("content")
    {!! Html::script('js/angular.min.js', array('type' => 'text/javascript')) !!}
    {!! Html::script('js/purchase.js', array('type' => 'text/javascript')) !!}
    <div class="panel panel-default" ng-app="purchaseApp">
        <div class="panel-heading">Add New Expense</div>
        <div class="panel-body" ng-controller="purchaseController">
            @if (Session::has('message'))
                <div class="alert alert-info">{{ Session::get('message') }}</div>
            @endif
            {!! Form::model($expense,  ['method'=>'PATCH', 'action'=>['ExpenseController@update', $expense], 'files'=>true]) !!}
            <div class="form-group col-md-4">
                <label for="expense_category">Select a Expense Category : </label>
                {!! Form::select('expense_category_id', $expense_categories, null, array('required', 'class'=> 'form-control', 'id'=> 'expense_category', 'placeholder'=>'Select a supplier')) !!}
            </div>
            <div class="form-group col-md-12">
                {!! Form::textarea('description', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Expense Description here')) !!}
            </div>
            <div class="form-group col-md-3">
                <label for="qty" >Enter Quantity : </label>
                {!! Form::number('qty', null, array('required', 'id'=> 'qty', 'class' => 'form-control', 'ng-model'=>'exqty', 'ng-init'=>"exqty='$expense->qty'")) !!}
            </div>
            <div class="form-group col-md-3">
                <label for="unit_expense" >Unit Expense : </label>
                {!! Form::number('unit_expense', null, array('required', 'step' => 'any', 'id'=> 'unit_expense', 'class' => 'form-control', 'ng-model'=>'unitExpense','ng-init'=>"unitExpense='$expense->unit_expense'")) !!}
            </div>
            <div class="form-group col-md-2">
                <label for="sub_total">Total : </label>
                <div class="sub_total_text"><span data-ng-bind="exqty * unitExpense | currency"></span></div>
            </div>

            <div class="col-md-2 form-group">
                {!! Form::submit('Update Expense', array('class'=> 'btn btn-primary complete-btn')) !!}
            </div>
            {!! Form::close() !!}
        </div>
    </div>
@endsection