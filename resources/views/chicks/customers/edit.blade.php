@extends("layouts.app")
@section("content")
<div class="panel panel-default">
    <div class="panel-heading">Edit Chicks Customer</div>
    <div class="panel-body">
        @if (Session::has('message'))
            <div class="alert alert-info">{{ Session::get('message') }}</div>
        @endif
        {!! Form::model($customer,['method'=>'PATCH', 'action'=>['ChickCustomerController@update', $customer], 'files'=>true]) !!}
            <div class="form-group col-md-4">
                {!! Form::text('name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Customer Name')) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::text('phone', null, array('required', 'class' => 'form-control', 'placeholder' =>'Phone No')) !!}
            </div>
            <div class="form-group col-md-4">
                {!! Form::file('image', null, array('required', 'class'=>'form-control')) !!}
            </div>
            <div class="form-group col-md-7">
                {!! Form::textarea('address', null, array('required', 'class'=>'form-control', 'placeholder'=> 'Enter Customer Address here')) !!}
            </div>
                <div class="col-md-5 editing-img">
                    <img src="{{asset($customer->image)}}" class="img-responsive img-rounded img-editing" alt="">
                </div>
                <div class="clearfix"></div>
                <div class="form-group col-md-4">
                    <label for="balance">Previous Balance</label>
                    {!! Form::number('balance', null, array('required', 'step'=>'any', 'class'=>'form-control', 'id'=>'balance', 'placeholder'=> 'Tk. 0.00')) !!}
                </div>
                <div class="form-group col-md-4">
                <label for="payment">Payment</label>
                {!! Form::number('payment', null, array('required', 'step'=>'any', 'class'=>'form-control', 'id'=>'payment', 'placeholder'=> 'Tk. 0.00')) !!}
                </div>
                <div class="col-md-2 form-group">
                    {!! Form::submit('Update Customer', array('class'=> 'btn btn-primary complete-btn')) !!}
                </div>
        {!! Form::close() !!}
    </div>
</div>
@endsection