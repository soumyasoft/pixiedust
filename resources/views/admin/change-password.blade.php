@extends('admin.layouts.master')
@section('title', 'Change Password')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Change Password</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Change Password</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <!-- left column -->
                <div class="col-md-12">
                    <!-- general form elements -->
                    <div class="card card-primary">
                        @include('admin.includes.msg')
                        <div class="card-header">
                            <h3 class="card-title">Change Password</h3>
                        </div>               

                        {!! Form::open(['url' => 'change-password','data-toggle'=>"validator",'role' => 'form', 'class' =>'validate', 'name' => 'change-password', 'id' => 'change-password','files'=>true, 'autocomplete' => 'off']) !!}
                        <div class="card-body">
                            <div class="form-group">                                    
                                <label for="name">Current Password</label>                                    
                                {!! Form::password('current_password', ['id' => 'current_password','required', 'class'=>'form-control', 'placeholder'=>'Current Password']) !!}
                                @if ($errors->has('current_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('current_password') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="new_password">New Password</label>                                    
                                {!! Form::password('new_password', ['id' => 'new_password','required', 'class'=>'form-control', 'placeholder'=>'New Password']) !!}
                                @if ($errors->has('new_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('new_password') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="confirm_password">Confirm Password</label>                                    
                                {!! Form::password('confirm_password', ['data-match'=>"#new_password",'data-match-error'=>"Whoops, these don't match",'id' => 'confirm_password','required', 'class'=>'form-control', 'placeholder'=>'Confirm Password']) !!}
                                @if ($errors->has('confirm_password'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('confirm_password') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div> 
                            </div>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            {{ Form::submit('Change Password', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('admin/home') }}" class="btn btn-warning">Back</a> 
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
