@extends('admin.layouts.master')
@section('title','Edit Massage Therapists')
@section('content')

<script type="text/javascript" src="{{ asset('public/admin/ckeditor/ckeditor.js') }}"></script>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Massage Therapists</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Edit Massage Therapists</li>
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
                            <h3 class="card-title">Edit Massage Therapists</h3>
                        </div>               

                        {!! Form::open(['url' => 'massage-therapists-update','data-toggle'=>"validator",'role' => 'form', 'class' =>'validate', 'name' => 'massage-therapists-update', 'id' => 'massage-therapists-update','files'=>true, 'autocomplete' => 'off']) !!}

                        <div class="card-body">
                            <div class="form-group">                                    
                                <label for="title">Description</label>                                    
                                {!! Form::textarea('description',$getMassageTherapists->description,['id' => 'description','required', 'class'=>'form-control ckeditor']) !!}

                                @if ($errors->has('description'))
                                <span class="help-block">
                                    <strong>{{ $errors->first('description') }}</strong>
                                </span>
                                @endif
                                <div class="help-block with-errors"></div>
                            </div> 
                        </div>
                        <!-- /.card-body -->

                        <div class="card-footer">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('admin/massage-therapists') }}" class="btn btn-warning">Back</a> 
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