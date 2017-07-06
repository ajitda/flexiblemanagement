@extends("layouts.app")
@section("content")
<div class="panel panel-default">
    <div class="panel-heading">Edit Bird Supplier</div>
    <div class="panel-body">
        {!! Form::model($supplier,['method'=>'PATCH', 'action'=>['SuppliersController@update', $supplier], 'files'=>true]) !!}
            <div class="form-group col-md-4">
                {!! Form::text('supplier_name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Supplier Name')) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::text('phone', null, array('required', 'class' => 'form-control', 'placeholder' =>'Phone No')) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-md-7">
                {!! Form::textarea('address', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Supplier Address here')) !!}
            </div>
            <div class="col-md-5 editing-img">
                <img src="{{asset($supplier->image)}}" class="img-responsive img-rounded img-editing" alt="">
            </div>
            <div class="clearfix"></div>
            <div class="col-md-2 form-group">
                {!! Form::submit('Update Bird Supplier', array('class'=> 'btn btn-primary')) !!}
            </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection