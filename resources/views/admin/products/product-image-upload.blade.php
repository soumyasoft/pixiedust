@extends('admin.layouts.master')
@section('title','Add Product Images')
@section('content')

<link href="{{}}" rel="stylesheet">

<script src="http://demo.expertphp.in/js/dropzone.js"></script>

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Product Images</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Product Images</li>
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
                        <div class="card-header">
                            <h3 class="card-title">Add Product Images</h3>
                        </div>               
                        {{ Form::open(['route' => 'banners.store','data-toggle'=>"validator", 'role' => 'form', 'class' =>'validate', 'name' => 'add-banner', 'id' => 'add-banner','files'=>true, 'autocomplete' => 'off']) }}

                        <div class="card-body">
                            <div class="form-group">                                    
                                <label for="banner">Banner</label>                                    
                                {!! Form::file('banner', ['id' => 'banner','onchange'=>"return imageExtValidation('banner')",'required', 'class'=>'form-control','accept'=>"jpg,png"]) !!}
                                @if ($errors->has('banner'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('banner') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>  
                            <span style="color: red;">Note:Please upload 1920*550 banner for better quality.Image extension should be .jpeg.jpg.png.gif only</span>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            {{ Form::submit('Upload', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('admin/products') }}" class="btn btn-warning">Back</a> 
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
@stop