@extends("layouts.app")
@section("content")
<div class="panel panel-default">
    <div class="panel-heading">Add New Supplier</div>
    <div class="panel-body">
    {!! Form::open(['route'=>'chicksuppliers.store', 'files'=>true]) !!}
    <div class="form-group col-md-4">
        {!! Form::text('supplier_name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Supplier Name')) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::text('phone', null, array('required', 'class' => 'form-control', 'placeholder' =>'Phone No')) !!}
    </div>
    <div class="form-group col-md-4">
        {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
    </div>
    <div class="form-group col-md-12">
        {!! Form::textarea('address', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Supplier Address here')) !!}
    </div>
        <div class="col-md-2 form-group">
            {!! Form::submit('Add', array('class'=> 'btn btn-primary')) !!}
        </div>
    {!! Form::close() !!}
    </div>
</div>
@endsection