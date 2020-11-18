@extends('layouts.master')
@section('title') {{ "User Login" }} @stop
@section('keywords'){{ "User Login" }} @stop
@section('description'){{ "User Login" }} @stop
@section('content')


<div class="contact-form-area ptb-70 mt-50">
    <div class="container">
        <div id="checkout-login" class="row">   
            <div class="col-md-12">
                <h4 class="login-title-btm">User Login</h4> 
                <div class="coupon-text error" id="msgl_div" style="color: red;"></div>           
                <div class="coupon-text success" id="msg2_div" style="color: green;"></div>           
                {{ Form::open(array('url' => 'user-login-process', 'role' => 'form', 'class' =>'', 'name' => 'frm_user_login', 'id' => 'frm_user_login','files'=>true, 'autocomplete' => 'off')) }}

                <p class="form-row-first">
                    <label style="width: 100%;">Email <span class="required">*</span></label>
                    {!! Form::email('email',old('email'), array('id' => 'email','required','class'=>'form-control','placeholder'=>'Email','autocomplete' => 'off')) !!}
                </p>
                <p class="form-row-last">
                    <label style="width:100%;">Password  <span class="required">*</span></label>
                    {!! Form::password('user_password',  array('id' => 'user_password','required', 'class'=>'form-control', 'placeholder' => 'Password', 'autocomplete' => 'off')) !!}

                </p>
                <p class="form-row">					
                    <input type="button" name="user_login" value="Login" onclick="submitLoginForm();" class="colorb mt-0  wid100">
                </p>

                <p class="form-row text-center">	
                    <a href="{{ url('/forgot-password') }}" class="forgot-p">Forgot Password</a>
                </p>
                {{ Form::close() }}
            </div> 
        </div>
    </div>
</div>
<div id="ajax_loader" class="loader">
    <span style="position:relative; top:50%;">        
        <div class="spinner"></div>
    </span>
</div>


@endsection
