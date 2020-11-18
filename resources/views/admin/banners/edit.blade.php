@extends('admin.layouts.master')
@section('title','Edit Banner')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Banner</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Banner</li>
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
                            <h3 class="card-title">Edit Banner</h3>
                        </div>               
                        {!! Form::model($banner, ['method' => 'PATCH','route' => ['banners.update', $banner->id],'data-toggle'=>"validator", 'role' => 'form','files'=>true]) !!}
                        <div class="card-body">
                            <div class="form-group">                                    
                                <label for="banner">Banner</label>                                    
                                {!! Form::file('banner',['id' => 'banner','onchange'=>"return imageExtValidation('banner')",'required', 'class'=>'form-control','accept'=>"jpg,png"]) !!}
                                @if ($errors->has('banner'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('banner') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>  
                            <div><img width="150px;" src="{{ asset('public/images/banner/'.$banner->banner) }}"></div>

                            <span style="color: red;">Note:Please upload 1920*550 banner for better quality.Image extension should be .jpeg.jpg.png.gif only</span>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('admin/banners') }}" class="btn btn-warning">Back</a> 
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