@extends('admin.layouts.master')
@section('title', 'Payment Setting')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Payment Setting</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Payment Setting</li>
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
                            <h3 class="card-title">Payment Setting</h3>
                        </div>               

                        {!! Form::open(['url' => 'update-payment-setting','data-toggle'=>"validator",'role' => 'form', 'class' =>'validate', 'name' => 'update-payment-setting', 'id' => 'update-payment-setting','files'=>true, 'autocomplete' => 'off']) !!}
                        <div class="card-body">
                            <div class="form-group">                                    
                                <label for="paypal_enviroment">Paypal Enviroment</label>
                                <div class="form-check">    
                                    {!! Form::radio('paypal_environment',"1",$getPaymentSetting->paypal_environment == 1, ['id' => 'paypal_environment','required', 'class'=>'form-check-input']) !!}
                                    <label class="form-check-label">Sandbox</label>
                                    {!! Form::radio('paypal_environment',"2",$getPaymentSetting->paypal_environment == 2, ['style'=>"margin-left: 10px;",'id' => 'paypal_environment','required', 'class'=>'form-check-input']) !!}
                                    <label class="form-check-label" style="margin-left: 26px;">Live</label>
                                    <div class="help-block with-errors"></div>
                                </div>

                                @if ($errors->has('paypal_environment'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('paypal_environment') }}</strong>
                                </span>
                                @endif

                            </div>
                            <div class="form-group">                                    
                                <label for="new_password">Paypal ID</label>                                    
                                {!! Form::email('paypal_email',$getPaymentSetting->paypal_email, ['id' => 'paypal_email','required', 'class'=>'form-control', 'placeholder'=>'Paypal Email']) !!}
                                @if ($errors->has('paypal_email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('paypal_email') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
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
