@extends('admin.layouts.master')
@section('title','Manage Intutive Price Reading')
@section('content')

<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Intutive Price Reading</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Price Reading</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">        
                @include('admin.includes.msg')
                <div class="card">
                    <div class="card-header">
                        <h3 class="card-title">Manage Intutive Price Reading</h3>

                    </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL. No </th>
                                    <th>Timing</th>
                                    <th>Price</th>                                                                     
                                    <th>Action</th>                                                                     
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($getIntutivePrices as $getIntutivePrice)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $getIntutivePrice->intutive_timing }} Mins</td>
                                    <td>${{ $getIntutivePrice->price }}</td>                                    
                                    <td>      
                                        <a data-toggle="tooltip" title="Edit" href="{{ url('admin/intutive-reading-price-edit/'.$getIntutivePrice->id) }}" class="btn btn-primary btn-sm">
                                            <i class="fa fa-edit"></i>
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
