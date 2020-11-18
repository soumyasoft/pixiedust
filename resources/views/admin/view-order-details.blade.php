@extends('admin.layouts.master')
@section('title', 'Order Details')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Order Details</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/admin') }}">Home</a></li>
                        <li class="breadcrumb-item active">Order Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">

                    <!-- Main content -->
                    <div class="invoice p-3 mb-3">
                        <!-- title row -->
                        <div class="row">
                            <div class="col-12">
                                <h4>                                    
                                    <small class="float-right">Order Date: {{ date('d/m/Y',strtotime($getOrderDetails->created_at)) }}</small>
                                </h4>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- info row -->
                        <div class="row invoice-info">
                            <div class="col-sm-4 invoice-col">
                                <strong>Billing Address</strong>
                                <address>
                                    {{ $getOrderDetails->bill_first_name." ".$getOrderDetails->bill_last_name }}<br>
                                    {{ $getOrderDetails->bill_address1 }}<br>
                                    {{ $getOrderDetails->bill_address2 }}<br>
                                    City : {{ $getOrderDetails->bill_city }},State : {{ $getOrderDetails->bill_state }}<br>Country : {{ $getOrderDetails->bill_country }} Pincode: {{ $getOrderDetails->bill_post_code }}<br>
                                    Phone: {{ $getOrderDetails->bill_phone_number }}<br>
                                    Email: {{ $getOrderDetails->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">
                                <strong>Shipping Address</strong>
                                <address>
                                    {{ $getOrderDetails->ship_full_name }}<br>
                                    {{ $getOrderDetails->ship_address1 }}<br>
                                    {{ $getOrderDetails->ship_address2 }}<br>
                                    City : {{ $getOrderDetails->ship_city }},State : {{ $getOrderDetails->ship_state }}<br>Country : {{ $getOrderDetails->ship_country }} Pincode: {{ $getOrderDetails->bill_post_code }}<br>
                                    Phone: {{ $getOrderDetails->ship_phone_number }}<br>
                                    Email: {{ $getOrderDetails->email }}
                                </address>
                            </div>
                            <!-- /.col -->
                            <div class="col-sm-4 invoice-col">                                
                                <b>Order ID:</b> {{ $getOrderDetails->id }}<br>
                                <b>Amounte:</b> ${{ $getOrderDetails->total_amount }}<br>                               
                            </div>                       
                        </div>

                        <div class="row">
                            <div class="col-12 table-responsive">
                                <table class="table table-striped">
                                    <thead>
                                        <tr>
                                            <th>SL No.</th>
                                            <th>Product Name</th>
                                            <th>Quantity</th>
                                            <th>Unit Price</th>
                                            <th>Total</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach($getOrderDetails->orderItems as $orderItem)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>{{ getProductDetails($orderItem->product_id)->name }}</td>
                                            <td>{{ $orderItem->quantity }}</td>
                                            <td>${{ $orderItem->unit_price }}</td>
                                            <td>${{ $orderItem->total_price }}</td>                                            
                                        </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>
                            <!-- /.col -->
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <!-- accepted payments column -->

                            <div class="col-6">                                   
                                <span id="succ_msg" style="color: green;padding-left: 24px;"></span>
                                <div id="ajax_loader_admin" style="display: none;" class="admin_view_order"><img src="{{ asset('public/images/ajax-loader.gif') }}" /></div>
                                {{ Form::open(['url' => '','data-toggle'=>"validator",'method'=>'post', 'role' => 'form', 'class' =>'validate', 'name' => 'ship-update', 'id' => 'ship-update','files'=>true, 'autocomplete' => 'off']) }}

                                <div class="card-body">
                                    <div class="form-group">                                    
                                        <label for="name">Order Status</label> 
                                        {!! Form::hidden('order_id',old('shipping_url',$getOrderDetails->id), ['id' => 'shipping_url']) !!}
                                        {!! Form::select('order_status', ['1'=>'Shipped',0=>"Not Shipped"], $getOrderDetails->order_status, [($getOrderDetails->order_status ? 'disabled':''),'id' => 'order_status','class' => 'form-control','required','placeholder'=>'Choose Status']) !!}                                        
                                        @if ($errors->has('name'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('name') }}</strong>
                                        </span>
                                        @endif
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">                                    
                                        <label for="shipping_url">Tracking URL</label>                                    
                                        {!! Form::url('shipping_url',old('shipping_url',$getOrderDetails->shipping_url), [($getOrderDetails->shipping_url ? 'disabled':''),'id' => 'shipping_url','required', 'class'=>'form-control']) !!}
                                        @if ($errors->has('shipping_url'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('shipping_url') }}</strong>
                                        </span>
                                        @endif
                                        <div class="help-block with-errors"></div>
                                    </div>
                                    <div class="form-group">                                    
                                        <label for="tracking_id">Tracking No</label>                                    
                                        {!! Form::text('tracking_id',old('tracking_id',$getOrderDetails->tracking_id), [($getOrderDetails->tracking_id ? 'disabled':''),'id' => 'tracking_id','required', 'class'=>'form-control']) !!}
                                        @if ($errors->has('tracking_id'))
                                        <span class="help-block">
                                            <strong>{{ $errors->first('tracking_id') }}</strong>
                                        </span>
                                        @endif
                                        <div class="help-block with-errors"></div>
                                    </div>

                                </div>
                                <!-- /.card-body -->

                                <div class="card-footer">
                                    {{ Form::submit('Update', [($getOrderDetails->shipping_url ? 'disabled':''),'class' => 'btn btn-success','id'=>'updt_btn']) }}
                                    <a href="{{ url('admin/manage-orders') }}" class="btn btn-warning">Back</a> 
                                </div>
                                {!! Form::close() !!}

                            </div>
                            <!-- /.col -->
                            <div class="col-6">

                                <div class="table-responsive">
                                    <table class="table">
                                        <tr>
                                            <th style="width:50%">Subtotal:</th>
                                            <td>${{ number_format($getOrderDetails->orderItems->sum('total_price'),2) }}</td>
                                        </tr>
                                        <tr>
                                            <th>Discount</th>
                                            <td>${{ $getOrderDetails->discount_amount }}</td>
                                        </tr>
                                        <tr>
                                            <th>Shipping:</th>
                                            <td>${{ $getOrderDetails->shipping_amount ? $getOrderDetails->shipping_amount:"0.00" }}</td>
                                        </tr>
                                        <tr>
                                            <th>Total:</th>
                                            <td>${{ $getOrderDetails->total_amount }}</td>
                                        </tr>
                                    </table>
                                </div>
                            </div>
                            <!-- /.col -->
                        </div>
                    </div>
                    <!-- /.invoice -->
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
@endsection
