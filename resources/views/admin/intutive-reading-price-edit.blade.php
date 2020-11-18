@extends('admin.layouts.master')
@section('title','Edit Intutive Reading Price Setting')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Intutive Reading Price Setting</h1> 
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Intutive Reading Price Setting</li>
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
                            <h3 class="card-title">Edit Intutive Reading Price Setting</h3> 
                        </div>
                        {!! Form::open(['url' => 'intutive-readers-price-update','data-toggle'=>"validator",'role' => 'form', 'class' =>'validate', 'name' => 'intutive-readers-price-update', 'id' => 'intutive-readers-price-update','files'=>true, 'autocomplete' => 'off']) !!}
                        <div class="card-body">                           
                            <div class="form-group">
                                <label for="intutive_timing">Intutive Reading Timing</label> 
                                {!! Form::text('intutive_timing',old('intutive_timing',$getIntutivePrices->intutive_timing), ['disabled','id' => 'intutive_timing','required', 'class'=>'form-control']) !!} 
                                {!! Form::hidden('id',old('intutive_timing',$getIntutivePrices->id), ['id' => 'intutive_timing']) !!} 
                                @if ($errors->has('intutive_timing')) 
                                <span class="help-block"><strong>{{ $errors->first('intutive_timing') }}</strong> </span> 
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="price">Price</label> 
                                {!! Form::text('price',old('price',$getIntutivePrices->price), ['onkeypress'=>"return isNumberKey(event)",'id' => 'price','required', 'class'=>'form-control']) !!} 
                                @if ($errors->has('price')) 
                                <span class="help-block"><strong>{{ $errors->first('price') }}</strong> </span> 
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>                       
                        </div>
                        <div class="card-footer">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }} 
                            <a href="{{ url('admin/intutive-price-setting') }}" class="btn btn-warning">Back</a> 
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

@push('script')
<script src="{{ asset('public/admin/plugins/datepicker/jquery-ui.js') }}"></script>
<script type="text/javascript">
$(function () {
    $(".start_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        minDate: new Date(),
        showWeek: true,
        onClose: function (selectedDate) {
            $(".end_date").datepicker("option", "minDate", selectedDate);
        }
    });
});
$(function () {
    $(".end_date").datepicker({
        dateFormat: 'yy-mm-dd',
        changeMonth: true,
        changeYear: true,
        numberOfMonths: 1,
        minDate: new Date(),
        showWeek: true,
    });
});
</script>
@endpush