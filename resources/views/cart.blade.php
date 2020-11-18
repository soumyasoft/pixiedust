@extends('layouts.master')
@section('title') {{ "Cart" }} @stop
@section('keywords'){{ "Cart" }} @stop
@section('description'){{ "Cart" }} @stop
@section('content')

<div class="container mtb50">
    @if($getCartProducts->isNotEmpty())
    <div class="row" id="cart_details">
        <div class="col-md-8">
            <div class="card-container">                
                @foreach($getCartProducts as $getCartProduct)
                <div class="cart-card" id="cart_row_{{ $getCartProduct->id }}">
                    <table width="100%" border="1" cellspacing="0" cellpadding="0">
                        <tr>
                            <td width="20%">
                                <a href="{{ url('products/'.$getCartProduct->product->slug) }}">
                                    <img src="{{ asset('public/images/products/'.$getCartProduct->product->image) }}" alt="{{ $getCartProduct->product->name }}" title="" width="80"></a>
                                <div class="qty">
                                    <a class="qtyBtn mines1" href="javascript:void(0);" onclick="decrement_quantity({{ $getCartProduct->id }},{{ $getCartProduct->unit_price }})"><i class="fa fa-minus"></i></a>
                                    <input readonly type="text" name="quantity" value="{{ $getCartProduct->quantity }}" maxlength="2" id="input-quantity-{{ $getCartProduct->id }}" class="form-control cartqty" />

                                    <a class="qtyBtn plus1" href="javascript:void(0);" onclick="increment_quantity({{ $getCartProduct->id }},{{ $getCartProduct->unit_price }})"> <i class="fa fa-plus"></i></a><br />
                                    <div class="clear"></div>
                                </div>
                            </td>
                            <td width="7%" align="left" valign="bottom"></td>
                            <td align="left" valign="top">
                                <div class="col-sm-12">
                                    <h3 class="title">{{ $getCartProduct->product->name }}</h3>
                                    <ul class="price-box">
                                        <li class="price">
                                            <span class="price-new">${{ ($getCartProduct->product->discount_price) ? $getCartProduct->product->discount_price :$getCartProduct->product->price }}</span>
                                            <span class="price-old">{{ ($getCartProduct->product->price && $getCartProduct->product->discount_price) ? '$'.$getCartProduct->product->price : ""  }}</span>
                                            @if($getCartProduct->product->discount)
                                            <span class="of">{{ $getCartProduct->product->discount }}% off</span>
                                            @endif
                                        </li>
                                    </ul>
                                </div>
                                <a href="javascript:void(0)" onclick="deleteCartItem({{ $getCartProduct->id }})" class="remove-btn">REMOVE</a>
                            </td>
                        </tr>
                    </table>
                </div>
                @endforeach



                <div class="discount-code">
                    <!--<h1>Discount Codes</h1>-->
                    <p> <a href="#demo" class="demo-c collapsed" data-toggle="collapse" aria-expanded="false">
                            <i class="fa fa-tags" style="transform: rotate(85deg);"></i> <span>Enter your coupon code if you have one.</span></a></p>

                    <div id="demo" class="collapse {{ session()->get('coupon_code') ? "in" : "" }}" aria-expanded="false" style="height: 0px;" >

                        <p style="margin:0px;">
                            <input id="coupon_code" value="{{ session()->get('coupon_code') ? session()->get('coupon_code') : "" }}" required class="form-control ptb-8 wid70 no-bdr-radius no-border col-sm-6" placeholder="Coupon Code" autocomplete="off" name="coupon_code" type="text">
                            <input id="btn_submit" class="apply-coupon-btn" type="button" value="Apply Coupon" onclick="setCouponcode()">
                        </p> 
                        <div class="clearfix"></div>
                        <span style="color:red;display: inline-block" id="error_message"></span>
                        <span style="color:green;" id="success_message"></span>
                        <div style="color:#F00; height: 25px;"></div>
                    </div>
                </div>

                <div class="btn-container">
                    <a class="cont-shop"><span>Continue shopping</span></a>
                    <a class="pl-ord" href="{{ url('/checkout') }}"><span>Checkout Securely</span></a>
                </div>

            </div>
        </div>
        <div id="ajax_loader" class="loader">
            <span style="position:relative; top:50%;">
                <!--<img src="{{ asset('public/images/ajax-loader.gif') }}" alt="loader">-->
                <div class="spinner"></div>
            </span>
        </div>

        <div class="col-md-4">
            <div class="price-detail">
                <h3>Price Detail(s)</h3>
                <div class="total-shadow">                                   
                    <div class="over-flow pb-13">
                        <span class="pull-left cart-total">Total Price</span>
                        <span class="pull-right cart-total" id="disp_st">${{ cartDetails()->total_price }}</span>
                    </div>
                    <div class="mb-20 border-bottom over-flow pb-5" id="discount" style="display:{{ session()->get('discount_percentage') ? 'block':'none' }}">
                        <span class="pull-left cart-total">Discount (<span id="dicount_percentage">{{ session()->get('discount_percentage') }}%</span>)</span>
                        <span class="pull-right cart-total">
                            - $<span id="disp_ship_dsicount">{{ number_format($getDiscountCal['discountAmount'],2) }}</span>
                        </span>
                    </div>                    
                    <div class=" mb-20 border-bottom over-flow pb-5">
                        <span class="pull-left cart-total"> Delivery Charges</span>&nbsp<span style="color: green;" id="free_ship">{{ cartDetails()->total_price > 50 ? "(Free)" : "" }} </span>
                        <span class="pull-right cart-total">
                            + $<span id="disp_ship">{{ cartDetails()->total_price > 50 ? "0.00" : cartDetails()->total_shipping_price }}</span>
                        </span>
                    </div>
                    <div class=" mb-20 over-flow pt-7">
                        <span class="pull-left cart-total f-size-19"><strong>Amount Payable</strong></span>
                        <span class="pull-right cart-total f-size-19">
                            @if(session()->get('discount_percentage'))
                            $<span id="disp_gt" class="amount-bold">{{ cartDetails()->total_price > 50 ? $getDiscountCal['afterDiscountAmt']+0.00 : number_format($getDiscountCal['afterDiscountAmt']+cartDetails()->total_shipping_price,2) }}</span>
                            @else
                            $<span id="disp_gt" class="amount-bold">{{ cartDetails()->total_price > 50 ? cartDetails()->total_price+0.00 : number_format(cartDetails()->total_price+cartDetails()->total_shipping_price,2) }}</span> 
                            @endif
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>


<div class="container">
    @if($getCartProducts->isEmpty())
    <div class="row cart-emp-sec">       
        <div class="col-md-12 col-sm-12 col-xs-12" id="cart_emp_sec">
            <h3 class="crt-emt"><i class="fa fa-shopping-cart"></i> <br>
                Your shopping cart is empty....</h3><br>
            <div class="text-center csc">
                <a href="{{ url('/products') }}"><i class="fa fa-hand-pointer-o"></i> Click Here to Continue Shopping</a>
            </div>
        </div>

    </div>
    @endif
    <div class="row cart-emp-sec" style="display: none;" id="cart_emp_sec"> 
        <div class="col-md-12 col-sm-12 col-xs-12">
            <h3 class="crt-emt"><i class="fa fa-shopping-cart"></i> <br>
                Your shopping cart is empty....</h3><br>
            <div class="text-center csc">
                <a href="{{ url('/products') }}"><i class="fa fa-hand-pointer-o"></i> Click Here to Continue Shopping</a>
            </div>
        </div>
    </div>
</div>
@endsection