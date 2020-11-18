@extends('admin.layouts.master')
@section('title','Edit Massage Therapy Price Setting')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Massage Therapy Price Setting</h1> 
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Massage Therapy Price Setting</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
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
                            <h3 class="card-title">Edit Massage Therapy Price Setting</h3> 
                        </div>
                        {!! Form::open(['url' => 'massage-therapy-price-update','data-toggle'=>"validator",'role' => 'form', 'class' =>'validate', 'name' => 'intutive-readers-price-update', 'id' => 'intutive-readers-price-update','files'=>true, 'autocomplete' => 'off']) !!}
                        <div class="card-body">                           
                            <div class="form-group">
                                <label for="massage_timing">Massage Therapy Timing</label> 
                                {!! Form::text('massage_timing',old('intutive_timing',$getMassagePriceSetting->massage_timing), ['disabled','id' => 'intutive_timing','required', 'class'=>'form-control']) !!} 
                                {!! Form::hidden('id',old('id',$getMassagePriceSetting->id), ['id' => 'intutive_timing_id']) !!} 
                                @if ($errors->has('massage_timing')) 
                                <span class="help-block"><strong>{{ $errors->first('massage_timing') }}</strong> </span> 
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label> 
                                {!! Form::text('price',old('price',$getMassagePriceSetting->price), ['onkeypress'=>"return isNumberKey(event)",'id' => 'price','required', 'class'=>'form-control']) !!} 
                                @if ($errors->has('price')) 
                                <span class="help-block"><strong>{{ $errors->first('price') }}</strong> </span> 
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>                       
                        </div>
                        <div class="card-footer">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }} 
                            <a href="{{ url('admin/massage-therapy-price-setting') }}" class="btn btn-warning">Back</a> 
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            <!-- /.row -->
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@stop
