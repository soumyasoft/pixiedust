@extends('layouts.master')
@section('title') {{ "Contact Us" }} @stop
@section('keywords'){{ "Contact Us" }} @stop
@section('description'){{ "Contact Us" }} @stop
@section('content')

<div class="container mtb50">

    <div class="row">
        <!--Middle Part Start-->
        <div id="content" class="col-sm-12">
            <h1 class="title"><span>Contact Us</span></h1>

            <div class="row">
                <div class="col-sm-4">
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="fa fa-map-marker"></i></div>
                        <div class="contact-detail">
                            <h4>Our Address</h4>
                            <address>
                                {{ getAdminDetails()->address }}
                            </address>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="fa fa-phone"></i></div>
                        <div class="contact-detail">
                            <h4>Telephone</h4>
                            Call: {{ getAdminDetails()->contact_no }}</div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="contact-info">
                        <div class="contact-info-icon"><i class="fa fa-clock-o"></i></div>
                        <div class="contact-detail">
                            <h4>Opening Hours</h4>
                            {!! getAdminDetails()->opening_hours !!}
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-8">
                    @include('admin.includes.msg')
                    {!! Form::open(['url' => 'contact-us-email','class'=>"form-horizontal",'data-toggle'=>"validator",'class','role' => 'form', 'name' => 'contact-us-email', 'id' => 'contact-us-email','files'=>true, 'autocomplete' => 'off']) !!}
                    <fieldset>
                        <h3 class="subtitle"><span>Send us an Email</span></h3>
                        <div class="form-group required">
                            <label class="col-md-3 col-sm-3 control-label" for="input-name">Your Name</label>
                            <div class="col-md-9 col-sm-9">                                
                                {!! Form::text('name', '', ['id' => 'name','required', 'class'=>'form-control', 'placeholder'=>'Your Name']) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="form-group required">
                            <label class="col-md-3 col-sm-3 control-label" for="input-email">E-Mail Address</label>
                            <div class="col-md-9 col-sm-9">                                
                                {!! Form::email('email', '', ['id' => 'email','required', 'class'=>'form-control', 'placeholder'=>'E-Mail Address']) !!}
                                @if ($errors->has('email'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="form-group required">
                            <label class="col-md-3 col-sm-3 control-label" for="input-email">Contact No</label>
                            <div class="col-md-9 col-sm-9">                                
                                {!! Form::text('contact_no', '', ['id' => 'contact_no','required','onkeypress'=>"return isNumberKey(event)", 'class'=>'form-control', 'placeholder'=>'Contact No']) !!}
                                @if ($errors->has('contact_no'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('contact_no') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>

                        </div>
                        <div class="form-group required">
                            <label class="col-md-3 col-sm-3 control-label" for="input-enquiry">Enquiry</label>
                            <div class="col-md-9 col-sm-9">                                
                                {!! Form::textarea('enquiry', '', ['rows'=>"10",'id' => 'enquiry','required', 'class'=>'form-control', 'placeholder'=>'Write your message']) !!}
                                @if ($errors->has('enquiry'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('enquiry') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                    </fieldset>
                    <div class="buttons">
                        <div class="pull-right">
                            {{ Form::submit('Submit', ['class' => 'btn btn-primary']) }}                
                        </div>
                    </div>
                    {!! Form::close() !!}
                </div>

                <div class="col-sm-4">
                    <img src="{{ asset('public/images/contact-us.png') }}" alt=""></div>
            </div>
        </div>

        <!--Middle Part End -->
    </div>
</div>

@endsection
