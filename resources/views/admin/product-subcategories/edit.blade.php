@extends('admin.layouts.master')@section('title','Edit Sub Category')@section('content')<div class="content-wrapper">    <!-- Content Header (Page header) -->    <section class="content-header">        <div class="container-fluid">            <div class="row mb-2">                <div class="col-sm-6">                    <h1>Edit Sub Category</h1>                </div>                <div class="col-sm-6">                    <ol class="breadcrumb float-sm-right">                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>                        <li class="breadcrumb-item active">Edit Sub Category</li>                    </ol>                </div>            </div>        </div><!-- /.container-fluid -->    </section>    <!-- Main content -->    <section class="content">        <div class="container-fluid">            <div class="row">                <!-- left column -->                <div class="col-md-12">                    <!-- general form elements -->                    <div class="card card-primary">                           @include('admin.includes.msg')                        <div class="card-header">                            <h3 class="card-title">Edit Sub Category</h3>                        </div>                                      {!! Form::model($subCategory, ['method' => 'PATCH','route' => ['product-subcategories.update', $subCategory->id],'data-toggle'=>"validator", 'role' => 'form','files'=>true, 'autocomplete' => 'off']) !!}                        <div class="card-body">                            <div class="form-group">                                  <label for="name">Category Name</label>                                 {!! Form::select('category_id',getCategories(),$subCategory->category_id, ['id' => 'category_id','required', 'class'=>'form-control','placeholder'=>'Select Category']) !!}                                @if ($errors->has('category_id'))                                <span class="help-block">                                    <strong>{{ $errors->first('category_id') }}</strong>                                </span>                                @endif                                <div class="help-block with-errors"></div>                            </div>                            <div class="form-group">                                <label for="name">Name</label>                                {!! Form::text('name',old('name',$subCategory->name), ['id' => 'name','required', 'class'=>'form-control']) !!}                                @if ($errors->has('name'))                                <span class="help-block">                                    <strong>{{ $errors->first('name') }}</strong>                                </span>                                @endif                                <div class="help-block with-errors"></div>                            </div>                        </div>                        <div class="card-footer">                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}                            <a href="{{ url('admin/product-categories') }}" class="btn btn-warning">Back</a>                         </div>                        {!! Form::close() !!}                    </div>                </div>            </div>            <!-- /.row -->        </div><!-- /.container-fluid -->    </section>    <!-- /.content --></div>@stop