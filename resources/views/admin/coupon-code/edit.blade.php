@extends('admin.layouts.master')
@section('title','Edit Sub Category')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Edit Coupon Code</h1> 
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a>
                        </li>
                        <li class="breadcrumb-item active">Edit Coupon Code</li>
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
                            <h3 class="card-title">Edit Coupon Code</h3> 
                        </div>
                        {!! Form::model($couponCode, ['method' => 'PATCH','route' => ['coupon-code.update', $couponCode->id],'data-toggle'=>"validator", 'role' => 'form','files'=>true, 'autocomplete' => 'off']) !!}
                        <div class="card-body">                           
                            <div class="form-group">
                                <label for="coupon_code">Coupon Code</label> 
                                {!! Form::text('coupon_code',old('coupon_code'), ['id' => 'coupon_code','required', 'class'=>'form-control']) !!} 
                                @if ($errors->has('coupon_code')) 
                                <span class="help-block"><strong>{{ $errors->first('coupon_code') }}</strong> </span> 
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="start_date">Start Date</label> 
                                {!! Form::text('start_date',old('start_date'), ['readonly','id' => 'start_date','required', 'class'=>'form-control start_date']) !!} 
                                @if ($errors->has('start_date')) 
                                <span class="help-block"><strong>{{ $errors->first('start_date') }}</strong> </span> 
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="end_date">End Date</label> 
                                {!! Form::text('end_date',old('end_date'), ['readonly','id' => 'end_date','required', 'class'=>'form-control end_date']) !!} 
                                @if ($errors->has('end_date')) 
                                <span class="help-block"><strong>{{ $errors->first('end_date') }}</strong> </span> 
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                            <div class="form-group">
                                <label for="discount_percentage">Discount (In %)</label> 
                                {!! Form::text('discount_percentage',old('discount_percentage'), ['onkeypress'=>"return isNumberKey(event)",'id' => 'discount_percentage','required', 'class'=>'form-control']) !!} 
                                @if ($errors->has('discount_percentage')) 
                                <span class="help-block"><strong>{{ $errors->first('discount_percentage') }}</strong> </span> 
                                @endif
                                <div class="help-block with-errors"></div>
                            </div>
                        </div>
                        <div class="card-footer">
                            {{ Form::submit('Update', ['class' => 'btn btn-success']) }} 
                            <a href="{{ url('admin/coupon-code') }}" class="btn btn-warning">Back</a> 
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