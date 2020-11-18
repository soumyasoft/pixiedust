@extends('admin.layouts.master')
@section('title','Edit CMS Page')
@section('content')

<script type="text/javascript" src="{{ asset('public/admin/ckeditor/ckeditor.js') }}"></script>
<link rel="stylesheet" href="{{ asset('public/admin/plugins/iCheck/all.css')}}">
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>News Letter</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">News Letter</li>
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
                            <h3 class="card-title">News Letter</h3>
                        </div>               
                        {!! Form::open(['url' => 'send-newsletter','data-toggle'=>"validator",'role' => 'form', 'class' =>'validate', 'name' => 'send-newsletter', 'id' => 'send-newsletter','files'=>true, 'autocomplete' => 'off']) !!}
                        <div class="card-body all_chk">

                            <div class="form-group">
                                <label>
                                    <input type="checkbox" id="checkAll">
                                    All subscribed email address.
                                    <span style="float: right;">Action</span>
                                </label> 

                                @foreach($getNewsLetSubEmails as $getNewsLetSubEmail)
                                <label>
                                    <input type="checkbox">  
                                    {{ $getNewsLetSubEmail->email }}
                                    <button style="float: right;" class="btn btn-danger btn-sm btn-small" type="submit"><i class="fa fa-trash-o" aria-hidden="true"></i></button>                                   
                                </label>                                 
                                <hr>
                                @endforeach
                            </div>

                            <div class="form-group">                                    
                                <label for="title">Description</label>                                    
                                {!! Form::textarea('description',null,['id' => 'description','required', 'class'=>'form-control ckeditor']) !!}

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
                            {{ Form::submit('Send Email', ['class' => 'btn btn-success']) }}
                            <a href="{{ url('admin/home') }}" class="btn btn-warning">Back</a> 
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
@push('script')
<script src="{{ asset('public/admin/plugins/iCheck/icheck.min.js') }}"></script>
<script>
$(function () {
    $('input[type="checkbox"].flat-red, input[type="radio"].flat-red').iCheck({
        checkboxClass: 'icheckbox_flat-green',
        radioClass: 'iradio_flat-green'
    });

});
</script>
<script>
    $(document).ready(function () {
        $('#checkAll').on('click', function () {
            $("input:checkbox").prop('checked', $(this).prop("checked"));
        });
    });
</script>

@endpush