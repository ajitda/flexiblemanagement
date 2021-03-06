@extends("layouts.app")
@section("content")
<div class="panel panel-default">
    <div class="panel-heading">Add New Chicks Customer</div>
    <div class="panel-body">
    {!! Form::open(['route'=>'chickcustomers.store', 'files'=>true]) !!}
    <div class="form-group col-md-4">
        {!! Form::text('name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Customer Name')) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::text('phone', null, array('required', 'class' => 'form-control', 'placeholder' =>'Phone No')) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
    </div>
    <div class="form-group col-md-12">
        {!! Form::textarea('address', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Customer Address here')) !!}
    </div>
    <div class="form-group col-md-4">
        <label for="balance">Previous Balance</label>
        {!! Form::number('balance', null, array('required', 'step'=>'any', 'class'=>'form-control', 'id'=>'balance', 'placeholder'=> 'Tk. 0.00')) !!}
    </div>
    <div class="form-group col-md-4">
        <label for="payment">Payment</label>
        {!! Form::number('payment', null, array('required', 'step'=>'any', 'class'=>'form-control', 'id'=>'payment', 'placeholder'=> 'Tk. 0.00')) !!}
    </div>

    <div class="col-md-2 form-group complete-btn">
        {!! Form::submit('Add Chicks Customer', array('class'=> 'btn btn-primary')) !!}
    </div>
    {!! Form::close() !!}
    </div>
</div>
@endsection