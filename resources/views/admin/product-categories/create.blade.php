@extends('admin.layouts.master')
@section('title','Add Category')
@section('content')


<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Add Category</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Add Category</li>
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
                            <h3 class="card-title">Add Category</h3>
                        </div>               
                        {{ Form::open(['route' => 'product-categories.store','data-toggle'=>"validator", 'role' => 'form', 'class' =>'validate', 'name' => 'add-category', 'id' => 'add-category','files'=>true, 'autocomplete' => 'off']) }}

                        <div class="card-body">
                            <div class="form-group">                                    
                                <label for="name">Name</label>                                    
                                {!! Form::text('name',old('name'), ['id' => 'name','onchange'=>"return imageExtValidation('name')",'required', 'class'=>'form-control','accept'=>"jpg,png"]) !!}
                                @if ($errors->has('name'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('name') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">                                    
                                <label for="image">Image</label>                                    
                                {!! Form::file('image', ['id' => 'image','onchange'=>"return imageExtValidation('image')",'required', 'class'=>'form-control','accept'=>"jpg,png"]) !!}
                                @if ($errors->has('image'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('image') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>  
                            <span style="color: red;">Note:Please upload 500*150 image for better quality.Image extension should be .jpeg.jpg.png.gif only</span>
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            {{ Form::submit('Submit', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('admin/product-categories') }}" class="btn btn-warning">Back</a> 
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