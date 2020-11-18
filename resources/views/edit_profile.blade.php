@extends('layouts.master')
@section('title') {{ "Edit Profile" }} @stop
@section('keywords'){{ "Edit Profile" }} @stop
@section('description'){{ "Edit Profile" }} @stop
@section('content')

<div class="checkout-area">
    <div class="container" style="background:#fff;">
        <div class="row">
            <div class="pad100">                  
                {{ Form::open(array('url' => 'update-user-profile', 'role' => 'form',  'name' => 'edit_profile', 'id' => 'edit_profile','files'=>true, 'autocomplete' => 'off')) }}      
                <!--Billing Address DIV-->
                <div class="col-lg-12 col-md-12">
                    <div class="checkbox-form">
                        <h3 class="pdl10">Billing Details</h3>
                        <div class="row">
                            @include('admin.includes.msg')
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>First Name <span class="required">*</span></label>
                                    {!! Form::text('bill_first_name',old('bill_first_name',$getUserData->bill_first_name),array('id' => 'bill_first_name','required')) !!}
                                    @if ($errors->has('bill_first_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bill_first_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Last Name <span class="required">*</span></label>										
                                    {!! Form::text('bill_last_name',old('bill_last_name',$getUserData->bill_last_name),array('id' => 'bill_last_name','required')) !!}
                                    @if ($errors->has('bill_last_name'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bill_last_name') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Email Address <span class="required">*</span></label>
                                    {!! Form::email('email',old('email',$getUserData->email),array('id' => 'email','required')) !!}
                                    @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Phone  <span class="required">*</span></label>
                                    {!! Form::text('bill_phone_number',old('bill_phone_number',$getUserData->bill_phone_number),array('id' => 'bill_phone_number','onkeypress'=>"return isNumberKey(event)",'required')) !!}                                    
                                    @if ($errors->has('bill_phone_number'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bill_phone_number') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    {!! Form::text('bill_address1',old('bill_address1',$getUserData->bill_address1),array('id' => 'bill_address1','required')) !!}
                                    @if ($errors->has('bill_address1'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bill_address1') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    {!! Form::text('bill_address2',old('bill_address2',$getUserData->bill_address2),array('id' => 'bill_address2','required')) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Town / City <span class="required">*</span></label>										
                                    {!! Form::text('bill_city',old('bill_city',$getUserData->bill_city),array('id' => 'bill_city','required')) !!} 
                                    @if ($errors->has('bill_city'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bill_city') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Postcode / Zip <span class="required">*</span></label>
                                    {!! Form::text('bill_post_code',old('bill_post_code',$getUserData->bill_post_code),array('id' => 'bill_post_code','onkeypress'=>"return isNumberKey(event)",'required')) !!} 
                                    @if ($errors->has('bill_post_code'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bill_post_code') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>State <span class="required">*</span></label>										
                                    {!! Form::text('bill_state',old('bill_state',$getUserData->bill_state),array('id' => 'bill_state','required')) !!}
                                    @if ($errors->has('bill_state'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bill_state') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Country <span class="required">*</span></label>										
                                    {!! Form::text('bill_country',old('bill_country',$getUserData->bill_country),array('id' => 'bill_country','required')) !!} 
                                    @if ($errors->has('bill_country'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('bill_country') }}</strong>
                                    </span>
                                    @endif
                                </div>
                            </div> 


                            <div class="col-md-12">
                                <div class="clearfix padtop10"></div>                                 
                                {{ Form::submit('Update', array('class' => 'view-detail-btn update-btn pull-left padtpbtmlr10')) }}                                                        
                                &nbsp;&nbsp;                        
                                <a href="{{ url('/my-account') }}" class="view-detail-btn colorb change-password-btn padtpbtmlr10 f-weight100">My Account</a>     
                            </div>
                        </div>
                    </div>
                </div>
                {{ Form::close() }}    
            </div> 
        </div>
    </div>
</div>

@endsection
@push('script')
<script>
    $("#edit_profile").validate({
        //debug: true
    });
</script>
@endpush