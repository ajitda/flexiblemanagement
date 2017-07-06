@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-md-offset-2">
                <div class="panel panel-default">
                    <div class="panel-heading">Register</div>
                    <br>
                    <div class="panel-body">
                        @if($errors ->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        {!! Form::open(['route'=>'employees.store', 'files'=>true]) !!}
                        <div class="form-group col-md-8">
                            {!! Form::text('name', null, array('required', 'class'=> 'form-control', 'placeholder'=> 'Enter Employee Name')) !!}
                        </div>
                        <div class="form-group col-md-8">
                            {!! Form::email('email', null, array('required', 'class' => 'form-control', 'placeholder' =>'Enter Email')) !!}
                        </div>
                        <div class="form-group col-md-8">
                            {!! Form::select('role',  array('admin'=>'Admin', 'editor'=>'Editor', 'general'=>'General'), null, array('required', 'class'=>'form-control')) !!}
                        </div>
                        <div class="form-group col-md-8">
                            <input type="password" name="password", placeholder="Type a new password" class="form-control" required>
                        </div>
                        <div class="form-group col-md-8">
                            <input type="password" name="confirmed_password" placeholder="Confirm Password" class="form-control" required>
                        </div>
                            <div class="clearfix"></div>
                        <div class="col-md-3 form-group">
                            {!! Form::submit('Add Employee', array('class'=> 'btn btn-primary')) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
