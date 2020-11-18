@extends('admin.layouts.master')
@section('title','Manage Coupon Code')
@section('content')
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Manage Coupon Codes</h1> </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Manage Coupon Code</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- Main content -->
    <section class="content">
        <div class="row">
            <div class="col-12">
                @include('admin.includes.msg')
                <div class="card">
                    <div class="card-header"> <a class="btn btn-info float-right" style="color: #eee;" href="{{ route('coupon-code.create') }}"><i class="fa fa-plus"></i> Add Coupon Code</a>
                        <h3 class="card-title">Manage Coupon Codes</h3> </div>
                    <!-- /.card-header -->
                    <div class="card-body">
                        <table id="example1" class="table table-bordered table-striped">
                            <thead>
                                <tr>
                                    <th>SL. No </th>
                                    <th>Coupon Code</th>
                                    <th>Discount Percentage</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>                                    
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody> @foreach($getCouponCodes as $getCouponCode)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $getCouponCode->coupon_code }}</td>
                                    <td>{{ $getCouponCode->discount_percentage }}</td>
                                    <td>{{ $getCouponCode->start_date }}</td>
                                    <td>{{ $getCouponCode->end_date }}</td>
                                    <td>
                                        <!--<a href="" class="btn-sm btn-primary" data-toggle="tooltip" title="Edit"><i class="fa fa-edit"></i></a>-->
                                        <a data-toggle="tooltip" title="Edit" href="{{ route('coupon-code.edit',$getCouponCode->id) }}" class="btn btn-primary btn-sm"> <i class="fa fa-pencil-square-o"></i> </a> 

                                        @if($getCouponCode->status == 1)
                                        <a data-toggle="tooltip" title="In Active" onClick="return confirm('Are you sure you want to In Active this coupon code ?')" href="{{ url('inActive/'.$getCouponCode->id) }}" class="btn btn-success btn-sm"> <i class="fa fa-check-circle"></i> </a> 
                                        @else
                                        <a data-toggle="tooltip" title="Active" onClick="return confirm('Are you sure you want to Active this coupon code ?')" href="{{ url('active/'.$getCouponCode->id) }}" class="btn btn-danger btn-sm"> <i class="fa fa-times-circle"></i> </a> 
                                        @endif



                                        {!! Form::open(['method' => 'DELETE','route' => ['coupon-code.destroy', $getCouponCode->id],'style'=>'display:inline','onClick'=>"return confirm('Are you sure you want to delete this coupon code ?')"]) !!} {!! Form::button('<i class="fa fa-trash-o" aria-hidden="true"></i>', ['class' => 'btn btn-danger btn-sm btn-small','type'=>'submit']) !!} {!! Form::close() !!} </td>
                                </tr> 

                                @endforeach 
                                </tfoot>
                        </table>
                    </div>
                    <!-- /.card-body -->
                </div>
            </div>
        </div>
        <!-- /.row -->
    </section>
    <!-- /.content -->
</div>@stop