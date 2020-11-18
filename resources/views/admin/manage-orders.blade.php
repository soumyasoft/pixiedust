@extends('admin.layouts.master')
@section('title','Manage Orders')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Orders</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Orders</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">       

                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manage Orders</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL. No </th>
                                    <th>Order ID</th>
                                    <th>Order Date</th>
                                    <th>Name</th>
                                    <th>Order Status</th>
                                    <th>Transaction ID</th>
                                    <th>Total</th>
                                    <th>Actions</th>                                    
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getOrders as $getOrder)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $getOrder->id }}</td>                                    
                                    <td>{{ date('dS M Y',strtotime($getOrder->created_at)) }}</td>
                                    <td>{{ $getOrder->bill_first_name." ".$getOrder->bill_last_name }}</td>
                                    <td>{{ ($getOrder->order_status == 1) ? "Shipped" : "Not Yet Shipped" }}</td>                                    
                                    <td>{{ $getOrder->transaction_id }}</td>
                                    <td>${{ $getOrder->total_amount }}</td>
                                    <td>      
                                        <a data-toggle="tooltip" title="View" href="{{ url('admin/view-order-details/'.$getOrder->id) }}" class="btn btn-warning btn-sm">
                                            <i class="fa fa-eye"></i>
                                        </a>                                    

                                    </td>                                    
                                </tr>
                                @endforeach
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->
            </div>
            <!-- /.col -->
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>

@stop
