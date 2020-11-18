@extends('layouts.master')
@section('title') {{ "My Account" }} @stop
@section('keywords'){{ "My Account" }} @stop
@section('description'){{ "My Account" }} @stop
@section('content')

<div class="checkout-area">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-4">
                <h5 class="ac-head" style="border-bottom:solid 1px #fff;">My Account & Delivery Details <a href="{{ url('/edit-profile') }}" class="ac-edit">EDIT PROFILE</a></h5>

                <h5 class="ac-head"><i class="fa fa-user" aria-hidden="true"></i> My Account</h5>

                <div class="ac-block" >
                    <span>First Name : {{ $getUserDetails->bill_first_name }}</span>
                    <span>Last Name : {{ $getUserDetails->bill_last_name }}</span>      
                    <span>Email Address : {{ $getUserDetails->email }}</span>
                    <span>Phone : {{ $getUserDetails->bill_phone_number }}</span>
                </div>
                <h5 class="ac-head"><i class="fa fa-file-text" aria-hidden="true"></i> Billing Address</h5>

                <div class="ac-block" >
                    <span>{{ $getUserDetails->bill_address1 }} {{ $getUserDetails->bill_address2 }}</span>
                    <span>City : {{ $getUserDetails->bill_city }}</span>
                    <span> Post Code : {{ $getUserDetails->bill_post_code }}</span>
                    <span>State : {{ $getUserDetails->bill_state }} </span>
                    <span>Country : {{ $getUserDetails->bill_country }}</span>
                </div>
            </div> 

            <div class="col-lg-8 col-md-8">
                <div class="order-history-block">
                    <h5 class="ac-head"><i class="fa fa-file-text" aria-hidden="true"></i> Oder History</h5>
                    <table class="order-history table-striped mb-50" id="no-more-tables">                 

                        <thead>
                            <tr>
                                <th>Order Id</th>
                                <th>Order Date</th>
                                <th>Payer ID</th>
                                <th>Grand Total</th>
                                <th>Order Status</th>
                                <th>Details</th>
                            </tr>
                        </thead>
                        <tbody>
                            @if($getOrderDetails->count() > 0)
                            @foreach($getOrderDetails as $getOrderDetail)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ date('dS M Y',strtotime($getOrderDetail->created_at)) }}</td>
                                <td>{{ $getOrderDetail->transaction_id }}</td>
                                <td>${{ $getOrderDetail->total_amount }}</td>
                                <td>{{ ($getOrderDetail->order_status == 1) ? "Shipped" : "Not Yet Shipped" }}</td>
                                <td><a href="{{ url('/order-details/'.$getOrderDetail->id) }}"><i class="fa fa-search" aria-hidden="true"></i></a></td>
                            </tr>
                            @endforeach
                            @else
                            <tr><td colspan="6" class="no-ord-f red">No Order Found!!</td></tr>
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>



@endsection
