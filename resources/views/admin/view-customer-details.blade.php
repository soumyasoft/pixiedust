@extends('admin.layouts.master')
@section('title', 'Customer Details')
@section('content')
<div class="content-wrapper">

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Customer Details</h1>
                </div>

                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('admin/home') }}">Home</a></li>
                        <li class="breadcrumb-item active">Customer Details</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <div class="row mb-2" style="margin-left: 5px;">
        <div class="col-md-12">
            <div class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">About <span style="color: greenyellow;">{{ $getCustomerDetails->bill_first_name." ".$getCustomerDetails->bill_last_name }}</span></h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <div class="col-md-6">
                        <strong>Name</strong>
                        <p class="text-muted">
                            {{ $getCustomerDetails->bill_first_name." ".$getCustomerDetails->bill_last_name }}
                        </p>
                        <hr>

                        <strong>Email</strong>
                        <p class="text-muted"> {{ $getCustomerDetails->email }}</p>
                        <hr>
                        <strong>Phone No</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">{{ $getCustomerDetails->bill_phone_number }}</span>                
                        </p>
                        <hr>
                        <strong>Address 1</strong>

                        <p class="text-muted">{{ $getCustomerDetails->bill_address1 }}</p>
                        <hr>
                        <strong>Address 2</strong>
                        <p class="text-muted">
                            {{ $getCustomerDetails->bill_address2 }}
                        </p>
                    </div>
                    <div class="col-md-6">
                        <strong>City</strong>
                        <p class="text-muted">{{ $getCustomerDetails->bill_city }}</p>
                        <hr>
                        <strong>Pincode</strong>

                        <p class="text-muted">
                            <span class="tag tag-danger">{{ $getCustomerDetails->bill_post_code }}</span>                
                        </p>
                        <hr>
                        <strong>State</strong>

                        <p class="text-muted">{{ $getCustomerDetails->bill_state }}</p>
                        <hr>                   
                        <strong>Country</strong>

                        <p class="text-muted">{{ $getCustomerDetails->bill_country }}</p>
                    </div>
                    <a class="btn btn-primary" href="{{ url('/admin/manage-customers') }}">Back</a>

                </div>


                <!-- /.card-body -->
            </div>
            <!-- /.card -->
        </div>

    </div>
</div>
@endsection
