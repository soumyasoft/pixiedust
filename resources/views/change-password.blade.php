@extends('layouts.master')
@section('title') {{ "Change Password" }} @stop
@section('keywords'){{ "Change Password" }} @stop
@section('description'){{ "Change Password" }} @stop
@section('content')
<div class="contact-form-area mtb50">
    <div class="container">
        <div id="checkout-login" class="row">
            <div class="col-md-12">
                <h4 class="login-title-btm">Change Password</h4>                 
                @include('admin.includes.msg')
                {{ Form::open(array('url' => 'update-password', 'role' => 'form', 'class' =>'', 'name' => 'frm_uup', 'id' => 'frm_uup','files'=>true, 'autocomplete' => 'off')) }}             
                <p class="form-row-first">
                    <label  class="wth100">Old Password <span class="required">*</span></label>                       
                    {!! Form::password('old_password',array('id' => 'old_password','required','class'=>'form-control','placeholder'=>'Old Password')) !!}
                    @if ($errors->has('old_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('old_password') }}</strong>
                    </span>
                    @endif
                </p>

                <p class="form-row-last">
                    <label class="wth100">New Password  <span class="required">*</span></label>
                    {!! Form::password('new_password',array('id' => 'new_password','required','class'=>'form-control','placeholder'=>'New Password')) !!}
                    @if ($errors->has('new_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('new_password') }}</strong>
                    </span>
                    @endif
                </p>

                <p class="form-row-last">
                    <label class="wth100">Confirm Password  <span class="required">*</span></label>
                    {!! Form::password('conf_password',array('id' => 'conf_password','required','class'=>'form-control','placeholder'=>'Confirm Password')) !!}
                    @if ($errors->has('conf_password'))
                    <span class="help-block">
                        <strong>{{ $errors->first('conf_password') }}</strong>
                    </span>
                    @endif
                </p>

                <p class="form-row">
                    {{ Form::submit('Change Password', array('class' => 'change-password-btn pull-left mr5')) }}
                    <a href="{{ url('/my-account') }}" class="  change-password-btn pull-left">My Account <i class="icon-angle-right"></i></a>
                </p>
                {{ Form::close() }}
            </div> 
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $("#frm_uup").validate({
        submitHandler: function (form) {

            form.submit();
        }
    });
</script>
@endpush