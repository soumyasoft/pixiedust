@extends('layouts.master')
@section('title'){{ "Checkout" }}@stop
@section('keywords'){{ "Checkout" }}@stop
@section('description'){{ "Checkout" }}@stop
@section('content')


<div class="checkout-area">
    <div class="container">
        <div class="row">
            
            @if(session()->get('user_id') == "")
            <div class="coupon-accordion">
                <!-- ACCORDION START -->
                <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                <!--Login Div-->
                <span id="err_msg_log" style="color: red;"></span>
                <span id="succ_msg_log" style="color:green;"></span>
                <div id="checkout-login" class="coupon-content" style="width: 100%; display:none;">
                    <div class="coupon-info">
                        <span id="msgl_div"></span>
                        {{ Form::open(array('url' => 'user-login-process', 'role' => 'form', 'class' =>'', 'name' => 'frm_user_login', 'id' => 'frm_user_login','files'=>true, 'autocomplete' => 'off')) }}

                        <p class="form-row-first col-md-5">
                            <label>Email <span class="required">*</span></label>
                            {!! Form::email('user_email',old('user_email'), array('id' => 'user_email','required','class'=>'','placeholder'=>'Email','autocomplete' => 'off')) !!}
                        </p>
                        <p class="form-row-last col-md-5">
                            <label>Password  <span class="required">*</span></label>
                            {!! Form::password('user_password',  array('id' => 'user_password','required', 'class'=>'', 'placeholder' => 'Password', 'autocomplete' => 'off')) !!}
                        </p>
                        <p class="form-row col-md-2">	
                            <label style="display:block;">&nbsp;</label>				
                            <input type="button" name="user_login" value="Login" class="single-action" onclick="submitCheckoutLoginForm();">
                        </p> 
                        {{ Form::close() }}
                    </div>
                </div>
            </div>
            @endif

            {!! Form::open(['url' => 'place-order','onSubmit'=>'return validatePlaceOrder();','method'=>'post','class'=>"form-horizontal", 'name' => 'checkout-form', 'id' => 'checkout-form','files'=>true, 'autocomplete' => 'off']) !!}

            <div class="col-lg-8 col-md-8">
                <!--Billing Address DIV-->
                <div class="checkbox-form checkbox-form-container">
                    <h3>Billing Details</h3>
                    <div style="height:15px">
                        <span id="err_msg" style="color: red;"></span>
                        <span id="succ_msg" style="color:green;"></span>
                    </div>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>First Name <span class="required">*</span></label>
                                {!! Form::text('bill_first_name',(Session::get('user_id'))?$user_details->bill_first_name:old('bill_first_name'),['id' => 'bill_first_name','placeholder'=>'First Name']) !!}
                            </div>
                        </div>                       

                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Last Name <span class="required">*</span></label>
                                {!! Form::text('bill_last_name',(Session::get('user_id'))?$user_details->bill_last_name:old('bill_last_name'),['id' => 'bill_last_name','placeholder'=>'Last Name']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Email Address <span class="required">*</span></label>
                                {!! Form::email('email',(Session::get('user_id'))? $user_details->email:old('email'),['id' => 'email','placeholder'=>'Email']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Phone  <span class="required">*</span></label>
                                {!! Form::text('bill_phone_number',(Session::get('user_id'))? $user_details->bill_phone_number:old('bill_phone_number'),['maxlength'=>'14','onkeypress'=>"return isNumberKey(event)",'id' => 'bill_phone_number','placeholder'=>'Phone Number']) !!}

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Address <span class="required">*</span></label>
                                {!! Form::text('bill_address1',(Session::get('user_id'))? $user_details->bill_address1:old('bill_address1'),['id' => 'bill_address1','placeholder'=>'Address 1']) !!}

                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                {!! Form::text('bill_address2',(Session::get('user_id'))? $user_details->bill_address2:old('bill_address2'),['id' => 'bill_address2','placeholder'=>'Address 2']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Town / City <span class="required">*</span></label>
                                {!! Form::text('bill_city',(Session::get('user_id'))? $user_details->bill_city:old('bill_city'),['id' => 'bill_city','placeholder'=>'City']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Postcode / Zip <span class="required">*</span></label>
                                {!! Form::text('bill_post_code',(Session::get('user_id'))? $user_details->bill_post_code:old('bill_post_code'),['onkeypress'=>"return isNumberKey(event)",'maxlength'=>7,'id' => 'bill_post_code','placeholder'=>'Pin/ZIP code']) !!}
                            </div>
                        </div>


                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>State <span class="required">*</span></label>
                                {!! Form::text('bill_state',(Session::get('user_id'))? $user_details->bill_state:old('bill_state'),['id' => 'bill_state','placeholder'=>'State']) !!}
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Country <span class="required">*</span></label>	
                                {!! Form::text('bill_country',(Session::get('user_id'))? $user_details->bill_country:old('bill_country'),['id' => 'bill_country','placeholder'=>'Country']) !!}
                            </div>
                        </div>                                  
                        <!--Generate Password DIV-->
                        @if(session()->get('user_id') == "")
                        <div class="col-md-12">
                            <div id="cbox_info" class="checkout-form-list">
                                <p>Create an account by entering the information. If you are a returning customer please login at the top of the page.</p>
                                <label>Account password  <span class="required">*</span></label>
                                <input id="account_password" class="" placeholder="" autocomplete="off" name="account_password" type="password" value="">	
                            </div>
                        </div> 
                        @endif
                    </div>



                    <div class="different-address">
                        <div class="ship-different-title">
                            <h3>
                                <label>Ship to a different address?</label>
                                <!--<input id="same_for_billing" class="" onclick="showShippingAddress()" name="same_for_billing" type="checkbox" value="1">-->
                                {!! Form::checkbox('same_for_billing', '1', false, ['onclick'=>"showShippingAddress()",'id' => 'same_for_billing']) !!}
                            </h3>
                        </div>

                        <!--Shipping Address DIV-->
                        <div id="ship-box-info" class="row" style="display: none;">
                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>First Name <span class="required">*</span></label>
                                    {!! Form::text('ship_first_name',(Session::get('user_id'))?$user_details->ship_first_name:old('ship_first_name'),['id' => 'ship_first_name','placeholder'=>'First Name']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Last Name <span class="required">*</span></label>	
                                    {!! Form::text('ship_last_name',(Session::get('user_id'))?$user_details->ship_last_name:old('ship_last_name'),['id' => 'ship_last_name','placeholder'=>'Last Name']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Phone  <span class="required">*</span></label>
                                    {!! Form::text('ship_phone_number',(Session::get('user_id'))? $user_details->ship_phone_number:old('ship_phone_number'),['maxlength'=>'14','onkeypress'=>"return isNumberKey(event)",'id' => 'ship_phone_number','placeholder'=>'Phone Number']) !!}
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    <label>Address <span class="required">*</span></label>
                                    {!! Form::text('ship_address1',(Session::get('user_id'))? $user_details->ship_address1:old('ship_address1'),['id' => 'ship_address1','placeholder'=>'Address 1']) !!}

                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="checkout-form-list">
                                    {!! Form::text('ship_address2',(Session::get('user_id'))? $user_details->ship_address2:old('ship_address2'),['id' => 'ship_address2','placeholder'=>'Address 2']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Town / City <span class="required">*</span></label>	
                                    {!! Form::text('ship_city',(Session::get('user_id'))? $user_details->ship_city:old('ship_city'),['id' => 'ship_city','placeholder'=>'City']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Postcode / Zip <span class="required">*</span></label>
                                    {!! Form::text('ship_post_code',(Session::get('user_id'))? $user_details->ship_post_code:old('ship_post_code'),['maxlength'=>7,'id' => 'ship_post_code','placeholder'=>'Pin/ZIP code']) !!}
                                </div>
                            </div>


                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>State <span class="required">*</span></label>
                                    {!! Form::text('ship_state',(Session::get('user_id'))? $user_details->ship_state:old('ship_state'),['id' => 'ship_state','placeholder'=>'State']) !!}
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="checkout-form-list">
                                    <label>Country <span class="required">*</span></label>	
                                    {!! Form::text('ship_country',(Session::get('user_id'))? $user_details->ship_country:old('ship_country'),['id' => 'ship_country','placeholder'=>'Country']) !!} 
                                </div>
                            </div>
                        </div>
                        <div class="order-notes">
                            <div class="checkout-form-list">
                                <label>Order Notes</label>
                                {!! Form::textarea('special_notes',(Session::get('user_id'))? $user_details->special_notes:old('special_notes'),['rows'=>"5",'id' => 'special_notes','placeholder'=>'Notes about your order, e.g. special notes for delivery.']) !!} 
                            </div>
                        </div>
                    </div>
                </div>

                <!--Order Details DIV-->

            </div> 

            <div class="col-lg-4 col-md-4 your-order-sec">

                <div class="your-order">
                    <h3>Your order</h3>
                    <div class="your-order-table table-responsive">
                        <table>
                            <tbody><tr class="bdr-btm">
                                    <td class="product-name"><strong>Product</strong></td>
                                    <td class="product-total"><strong>Total</strong></td>
                                </tr>


                                @foreach($getCartProducts as $getCartProduct)

                                <tr class="cart_item">
                                    <td width="70%" class="product-name">
                                        <a href="{{ url('products/'.$getCartProduct->product->slug) }}" style="float:left;">
                                            <img src="{{ asset('public/images/products/'.$getCartProduct->product->image) }}" alt="Iona" title="" width="80">
                                        </a>  

                                        <div class="centero">
                                            <p><span>{{ $getCartProduct->product->name }}
                                                    <strong class="product-quantity"> × {{ $getCartProduct->quantity }}</strong></span></p>
                                        </div>


                                    </td>
                                    <td width="30%" class="product-total">
                                        <span class="amount">${{ $getCartProduct->total_price }}</span>
                                    </td>
                                </tr>
                                @endforeach

                                <tr class="cart-subtotal bdr-tp">
                                    <td class="text-right">Cart Subtotal</td>
                                    <td>
                                        <span class="amount">
                                            <strong>${{ cartDetails()->total_price }}</strong>
                                        </span>
                                    </td>
                                </tr>

                                <tr class="shipping">
                                    <td class="text-right">Discount (<span>{{ session()->get('discount_percentage') ? session()->get('discount_percentage'):"" }}</span>%) ( - )</td>
                                    <td> ${{ session()->get('discount_percentage') ? number_format($getDiscountCal['discountAmount'],2):"0.00" }} </td>
                                </tr>
                                <tr class="shipping">
                                    <td class="text-right">Shipping</td>
                                    <td>${{ cartDetails()->total_price > 50 ? "0.00" : cartDetails()->total_shipping_price }}</td>
                                </tr>

                                <tr class="order-total bdr-tp">
                                    <td class="text-right">Order Total</td>
                                    <td><strong> 
                                            @if(session()->get('discount_percentage'))
                                            $<span class="amount">{{ cartDetails()->total_price > 50 ? $getDiscountCal['afterDiscountAmt']+0.00 : number_format($getDiscountCal['afterDiscountAmt']+cartDetails()->total_shipping_price,2) }}</span>
                                            @else
                                            $<span class="amount">{{ cartDetails()->total_price > 50 ? cartDetails()->total_price+0.00 : number_format(cartDetails()->total_price+cartDetails()->total_shipping_price,2) }}</span> 
                                            @endif
                                        </strong>
                                    </td>                                        
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="payment-method">
                        {!! Form::checkbox('accept_tc', '1', false, ['title'=>"Please agree to our policy!",'id' => 'accept_tc']) !!}
                        <a href="{{ url('/term-and-conditions') }}" target="_blank" style="display: block;">
                            <span id="disp_tc_mesg">Please accept Terms &amp; Conditions</span></a>                    
                        <div class="order-button-payment">                     
                            <input type="button" name="pla_ord" value="Place order" onclick="submitForm();" class="single-action" style="width:100%; margin-bottom:15px;">
                        </div>
                    </div>
                </div>

            </div>
            {!! Form::close() !!}
        </div>
    </div>
</div>
<div id="ajax_loader" class="loader">
    <span style="position:relative; top:50%;">        
        <div class="spinner"></div>
    </span>
</div>
@endsection
